# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "debian/stretch64"

    config.vm.host_name = "dev.foo"

    config.vm.network "private_network", ip: "192.168.56.102"
    config.vm.synced_folder '.', '/opt/chessdb', id: "vagrant-share", :nfs => true

    config.vm.provider "virtualbox" do |vb|
        vb.memory = "1024"
    end

    config.vm.provision "ansible_local" do |ansible|
        ansible.provisioning_path = "/opt/chessdb"
        ansible.playbook          = "ansible/devbox.yml"
    end
end
