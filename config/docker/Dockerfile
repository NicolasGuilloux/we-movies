FROM webdevops/php-nginx:8.0
MAINTAINER Nicolas Guilloux <nicolas.guilloux@protonmail.com>

# Add Node repository
RUN curl -sSL https://deb.nodesource.com/gpgkey/nodesource.gpg.key | apt-key add -
RUN echo "deb https://deb.nodesource.com/node_14.x stretch main" | tee /etc/apt/sources.list.d/nodesource.list
RUN echo "deb-src https://deb.nodesource.com/node_14.x stretch main" | tee -a /etc/apt/sources.list.d/nodesource.list

# Add Yarn repository
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

# Install dependencies
RUN apt update -y
RUN apt install nodejs yarn

# Set default directory and user
WORKDIR "/app"
USER application
