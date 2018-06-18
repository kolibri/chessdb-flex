import Chess from 'chess.js'

document.addEventListener("DOMContentLoaded", function () {
    let forEach = function (array, callback, scope) {
        for (let i = 0; i < array.length; i++) {
            callback.call(scope, i, array[i])
        }
    }
    let Chessboard = function (pgn) {
        let chess = new Chess()
        let cols = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h']
        let rows = [8, 7, 6, 5, 4, 3, 2, 1]
        let headers = {}

        let showMoves = pgn.dataset.showMoves
            ? (pgn.dataset.showMoves === 'true')
            : true
        let showHeader = pgn.dataset.showHeader
            ? (pgn.dataset.showHeader === 'true')
            : true
        let showButtons = pgn.dataset.showButtons
            ? (pgn.dataset.showButtons === 'true')
            : true
        let reversed = pgn.dataset.reversed
            ? (pgn.dataset.reversed === 'true')
            : false
        let labelNext = pgn.dataset.labelNext
            ? pgn.dataset.labelNext
            : 'next'
        let labelBack = pgn.dataset.labelBack
            ? pgn.dataset.labelBack
            : 'back'
        let labelReset = pgn.dataset.labelReset
            ? pgn.dataset.labelReset
            : 'reset'
        let labelTurn = pgn.dataset.labelTurn
            ? pgn.dataset.labelTurn
            : 'turn'
        let ply = pgn.dataset.ply
            ? parseInt(pgn.dataset.ply)
            : false
        let displayHeaders = pgn.dataset.displayHeaders
            ? pgn.dataset.displayHeaders.split(',')
            : ['White', 'Black', 'Date', 'Event', 'Result']
        let pieceNames = pgn.dataset.pieceNames
            ? JSON.parse(pgn.dataset.pieceNames)
            : {'k': 'K', 'q': 'Q', 'b': 'B', 'n': 'N', 'r': 'R', 'p': ''}

        let pgnString = pgn.innerHTML.trim().replace(/^\s+/gm, '')

        if (!chess.load_pgn(pgnString)) {
            return
        }

        let boardDiv = document.createElement('div')
        pgn.parentNode.insertBefore(boardDiv, pgn)

        if (reversed) {
            rows.reverse()
            cols.reverse()
        }

        let moves = chess.history({verbose: true})
        let currentMoveIndex = (false !== ply)
            ? ply
            : moves.length

        function drawPieces(board) {
            for (let y in rows) {
                for (let x in cols) {
                    let fieldname = cols[x] + rows[y]
                    let field = board.querySelector('.' + fieldname)
                    let piece = chess.get(fieldname)
                    field.classList.remove(
                        'wk', 'wq', 'wr', 'wb', 'wn', 'wp',
                        'bk', 'bq', 'br', 'bb', 'bn', 'bp'
                    )
                    if (piece && piece.color && piece.type) {
                        field.classList.add(piece.color + piece.type)
                    }
                }
            }
        }

        function formatMove(move) {
            let moveString = ''
            if (0 <= move.flags.indexOf('k')) {
                moveString = 'O-O'
            } else if (0 <= move.flags.indexOf('q')) {
                moveString = 'O-O-O'
            } else {
                moveString =
                    pieceNames[move.piece] +                                                       // piece name
                    move.from +                                                                   // from field
                    ((0 <= move.flags.indexOf('c') || 0 <= move.flags.indexOf('e')) ? 'x' : '-') + // capture sign
                    move.to +                                                                      // target field
                    ((0 <= move.flags.indexOf('e')) ? 'ep' : '') +                                  // en passant
                    ((0 <= move.flags.indexOf('p')) ? move.promotion : '')                        // promotion
            }

            // add check and checkmate flags
            if (0 <= move.san.indexOf('+')) {
                moveString = moveString + '+'
            }
            if (0 <= move.san.indexOf('#')) {
                moveString = moveString + '#'
            }

            return moveString
        }

        function getBoard() {
            let board = document.createElement('div')
            board.classList.add('board')
            let color = 'white'

            for (let y in rows) {
                let row = document.createElement('div')
                row.classList.add('row', 'r' + rows[y])
                for (let x in cols) {
                    let field = document.createElement('div')
                    let fieldname = cols[x] + rows[y]
                    field.classList.add('field', fieldname, color)
                    color = (color === 'white') ? 'black' : 'white'
                    row.appendChild(field)
                }
                color = (color === 'white') ? 'black' : 'white'
                board.appendChild(row)
            }

            return board
        }

        function importHeaders() {
            let importedHeaders = chess.header()

            for (let filterName in displayHeaders) {
                let name = displayHeaders[filterName]
                let value = importedHeaders[name]

                headers[name] = value
            }
        }

        function drawHeader() {
            let infos = document.createElement('dl')
            infos.classList.add('info')
            for (let headerName in headers) {
                let infoDt = document.createElement('dt')
                infoDt.appendChild(document.createTextNode(headerName))
                let infoDd = document.createElement('dd')
                infoDd.appendChild(document.createTextNode(headers[headerName]))
                infos.appendChild(infoDt)
                infos.appendChild(infoDd)
            }

            return infos
        }

        function getMoves(board) {
            let movesList = document.createElement('ol')
            movesList.classList.add('moves')
            for (let m in moves) {
                if ('w' === moves[m].color) {
                    let moveLi = document.createElement('li')
                    movesList.appendChild(moveLi)
                }

                let moveSpan = document.createElement('span')
                moveSpan.dataset.move = m

                moveSpan.addEventListener('click', function () {
                    gotoMove(parseInt(this.dataset.move) + 1)
                    drawPieces(board)
                })

                if (currentMoveIndex - 1 === moveSpan.dataset.move) {
                    moveSpan.classList.add('current')
                }

                moveSpan.appendChild(
                    document.createTextNode(formatMove(moves[m]))
                )
                moveLi.appendChild(moveSpan)
            }

            return movesList
        }

        function getButtons(board) {
            let buttons = document.createElement('div')
            buttons.classList.add('buttons')

            function addButton(label, callback) {
                let button = document.createElement('button')
                button.appendChild(document.createTextNode(label))
                button.addEventListener('click', callback)
                buttons.appendChild(button)
            }

            addButton(labelReset, function () {
                chess.reset()
                drawPieces(board)
                currentMoveIndex = 0
            })

            addButton(labelBack, function () {
                if (!currentMoveIndex > 0) {
                    return
                }
                chess.undo()
                currentMoveIndex = currentMoveIndex - 1
                drawPieces(board)
            })

            addButton(labelNext, function () {
                gotoMove(currentMoveIndex + 1)
                drawPieces(board)
            })

            addButton(labelTurn, function () {
                reversed = !reversed
                rows.reverse()
                cols.reverse()
                render()
            })

            return buttons
        }

        function gotoMove(moveIndex) {
            if (moveIndex > moves.length) {
                return
            }
            chess.reset()
            for (let n = 0; n < moveIndex; n++) {
                chess.move(moves[n])
            }
            currentMoveIndex = moveIndex
        }

        function render() {
            pgn.style.display = 'none'
            boardDiv.classList = pgn.classList
            boardDiv.classList.remove('pgn')
            boardDiv.classList.add('pgn-board')

            if (true === showHeader) {
                boardDiv.appendChild(drawHeader())
            }
            gotoMove(currentMoveIndex)
            let board = getBoard()
            drawPieces(board)

            boardDiv.appendChild(board)

            if (true === showButtons) {
                boardDiv.appendChild(getButtons(board))
            }

            if (true === showMoves) {
                boardDiv.appendChild(getMoves(board))
            }
        }

        this.init = function () {
            importHeaders()
            render()
        }
    }

    forEach(document.querySelectorAll('.pgn'), function (index, pgn) {
        let board = new Chessboard(pgn)
        board.init()
    })
})
