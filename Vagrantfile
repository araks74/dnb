VAGRANTFILE_API_VERSION = "2"
ENV['VAGRANT_DEFAULT_PROVIDER'] = "docker"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.define "dnb" do |v|
    v.vm.provider "docker" do |d|
      d.build_dir = "."

      if ENV['DOCKER_AGENT_TAG']
        d.name = ENV['DOCKER_AGENT_TAG']
      else
        d.name = "dnb"
        d.ports = ["8000:80"]
      end
      d.build_args = ["--tag", d.name]

      if RUBY_PLATFORM.downcase =~ /win32|mingw32/
        d.volumes = ["/vagrant:/var/www/dnb"]
      else
        d.volumes = [Dir.pwd + ":/var/www/dnb"]
      end
      
      if ENV['DOCKER_AGENT_TAG']
        d.volumes << "/var/lib/composer:/composer"
        d.volumes << "/var/run/memcached/memcached.sock:/external-memcached.sock"
        FileUtils.cp('./docker/local.php', './protected/config/local.php')
      end

      d.remains_running = true
      d.has_ssh = true

      d.vagrant_vagrantfile = "VagrantDockerProxy"
      d.vagrant_machine = "docker-proxy"
    end

    v.ssh.username = "root"
    v.ssh.private_key_path = "docker/docker_rsa"
    #v.ssh.password = "zxcvbnm"
  end
end
