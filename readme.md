![](https://viavictor.com/logos/Viavictor_Logo_Logo_Zwart.png)

------------


## Wordpress Docker Starterkit

#### 1. Clone Repositories
execute `git clone git@bitbucket.org:viavictor/wp-docker-starterkit.git`

##### Mac/Linux

------------
execute in terminal in root of project `sh clone.sh`

##### Windows

------------
execute `git clone git@bitbucket.org:viavictor/wp-theme-starterkit.git ./theme`

remove .git folder in theme/

execute `git clone git@bitbucket.org:viavictor/wp-core-starterkit.git ./web`

remove .git folder in web/


#### 2. Setup Environment
-  copy `.env.example` to `.env`
-  set  `PROJECT_NAME` in `.env`(the name can only have alphanumeric characters and dashes ex.: test-project)

###### add host entry in hostsfile
###### Mac / Linux

------------
- execute `sudo nano /etc/hosts`
- add entry `PROJECT_NAME.local 127.0.0.1`
- add entry `PROJECT_NAME.local ::1`

###### Windows

------------
- In Windows 10 the hosts file is located at c:\Windows\System32\Drivers\etc\hosts.
- Right click on Notepad in your start menu and select “Run as Administrator”. This is crucial to ensure you can make the required changes to the file.
- add entry IP_ADDRESS PROJECT_NAME.local www.PROJECT_NAME.local


#### 3. Start Environment
execute `docker-compose up -d`

#### 4.  Setup Wordpress
execute `docker exec -it PROJECT_NAME_wp_php /bin/bash`
execute in container `cd PROJECT_NAME`

follow steps in:
https://bitbucket.org/viavictor/wp-core-starterkit/src/master/README.md


#### 5.  Setup Theme
https://bitbucket.org/viavictor/wp-theme-starterkit/src/master/README.md

<br/>
<br/>
<br/>

## Configure Bitbucket Pipeline
---


### 1. Enable pipelines
```
Repository Settings > Pipelines Settings > Enable Pipelines
```

### 2. Configure SSH
SSH Keys can be found a https://drive.google.com/drive/folders/11TPwZIs9Ob54ABdJ7TefbPaCEH9XzksC?usp=sharing
<br/>
#### Bitbucket

```
Repository Settings > Pipelines SSH keys > Use my own keys
> paste private key (id_rsa)
> paste public key (id_rsa.pub)
> Save key pair
```

#### Combell
```
Go to webhosting of account > FTP & SSH > SSH > Activate SSH 
> SSH Keys > Add public key (id_rsa.pub)
```


### 3. Add Repository variables
```
Repository Settings > Pipelines Repository variables > Add variables
```

```sh
FTP_USER
FTP_PWD
FTP_HOST
FTP_PATH_STAGING
FTP_PATH_PRODUCTION
PROJECT_NAME
SSH_USER
SSH_SERVER
```


### 4. Add Deployment variables
```
Repository Settings > Deployments > ENVIRONMENT (staging / production) -> Add variables
```

```sh
DB_DATABASE_NAME
DB_USERNAME
DB_PASSWORD
DB_HOSTNAME
WP_DOMAIN_NAME
```

### 5. create bitbucket-pipelines.yml
```
Copy bitbucket-pipelines.yml.example to bitbucket-pipelines.yml
```