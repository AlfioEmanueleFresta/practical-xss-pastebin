Vagrant.configure("2") do |config|

    config.vm.box = "bento/debian-8.4"

    config.vm.provider "virtualbox" do |vb|
        vb.memory = "1024"
    end

    config.vm.network "forwarded_port", guest: 80, host: 8070
    config.vm.provision "shell", path: "provision.sh", env: {"PROJECTPATH" => "/vagrant/"}

end
