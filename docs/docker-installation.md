# Docker Installation Guide

This guide covers installing Docker on different operating systems.

## macOS

### Option 1: Using Homebrew (Recommended)

```bash
brew install --cask docker
```

After installation, open Docker from your Applications folder to complete the setup.

### Option 2: Docker Desktop

1. Download Docker Desktop from [https://docs.docker.com/desktop/install/mac-install/](https://docs.docker.com/desktop/install/mac-install/)
2. Open the downloaded `.dmg` file
3. Drag Docker to your Applications folder
4. Open Docker from Applications and follow the setup wizard

## Windows

### Requirements

- Windows 10 64-bit: Pro, Enterprise, or Education (Build 19041 or higher)
- Windows 11 64-bit: Home, Pro, Enterprise, or Education
- WSL 2 backend enabled

### Installation Steps

1. Download Docker Desktop from [https://docs.docker.com/desktop/install/windows-install/](https://docs.docker.com/desktop/install/windows-install/)
2. Run the installer (`Docker Desktop Installer.exe`)
3. Follow the installation wizard
4. Restart your computer when prompted
5. Open Docker Desktop from the Start menu

### Enable WSL 2 (if not already enabled)

Open PowerShell as Administrator and run:

```powershell
wsl --install
```

## Linux

### Ubuntu / Debian

```bash
# Update package index
sudo apt-get update

# Install prerequisites
sudo apt-get install ca-certificates curl gnupg

# Add Docker's official GPG key
sudo install -m 0755 -d /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
sudo chmod a+r /etc/apt/keyrings/docker.gpg

# Add the repository
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
  $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# Install Docker
sudo apt-get update
sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```

### Fedora

```bash
# Remove old versions
sudo dnf remove docker docker-client docker-client-latest docker-common docker-latest docker-latest-logrotate docker-logrotate docker-selinux docker-engine-selinux docker-engine

# Install dnf-plugins-core
sudo dnf -y install dnf-plugins-core

# Add the repository
sudo dnf config-manager --add-repo https://download.docker.com/linux/fedora/docker-ce.repo

# Install Docker
sudo dnf install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Start Docker
sudo systemctl start docker
sudo systemctl enable docker
```

### CentOS / RHEL

```bash
# Remove old versions
sudo yum remove docker docker-client docker-client-latest docker-common docker-latest docker-latest-logrotate docker-logrotate docker-engine

# Install yum-utils
sudo yum install -y yum-utils

# Add the repository
sudo yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo

# Install Docker
sudo yum install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Start Docker
sudo systemctl start docker
sudo systemctl enable docker
```

### Arch Linux

```bash
sudo pacman -S docker docker-compose

# Start Docker
sudo systemctl start docker
sudo systemctl enable docker
```

## Post-Installation (Linux)

### Run Docker without sudo

Add your user to the `docker` group:

```bash
sudo usermod -aG docker $USER
```

Log out and log back in for the changes to take effect.

### Verify Installation

```bash
docker --version
docker compose version
```

### Test Docker

```bash
docker run hello-world
```

## Troubleshooting

### Docker daemon not running

**Linux:**
```bash
sudo systemctl start docker
sudo systemctl status docker
```

**macOS/Windows:**
Open Docker Desktop application.

### Permission denied errors (Linux)

Make sure your user is in the docker group:
```bash
groups $USER
```

If `docker` is not listed, add yourself to the group and log out/in:
```bash
sudo usermod -aG docker $USER
```

### WSL 2 issues (Windows)

Update WSL:
```powershell
wsl --update
```

Set WSL 2 as default:
```powershell
wsl --set-default-version 2
```

## Additional Resources

- [Official Docker Documentation](https://docs.docker.com/)
- [Docker Engine Installation](https://docs.docker.com/engine/install/)
- [Docker Desktop](https://docs.docker.com/desktop/)
- [Docker Compose](https://docs.docker.com/compose/)
