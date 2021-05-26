# sar2html 4.0.0

sar2html is the plotting tool for system statistics (sar data) of following operating systems:
- HPUX 11.11, 11.23, 11,31
- Redhat 3, 4, 5, 6, 7
- Suse 8, 9, 10, 11, 12,
- Ubuntu 18, 20
- Solaris 5.9, 5.10, 5.11 are supported.

## RUNNING THE DOCKER IMAGE 
### ON DOCKER
If you want your performance data to be persistent you need to create directory for them in your host: 
```bash
mkdir /data
docker run -p 5000:5000 -v /data:/sar2html/data -d -h sar2html.localdomain cemtan/sar2html:4.0.0
```
Otherwise you may directly run the image:
```bash
docker run -p 5000:5000 -d -h sar2html.localdomain cemtan/sar2html:4.0.0
```

### ON KUBERNETES
- Simply run
```bash
kubectl run sar2html --image=cemtan/sar2html:4.0.0 --port=5000 --expose
```
- Or download repository and enter the directory
```bash
git clone https://github.com/cemtan/sar2html.git
cd sar2html/conf/kubernetes
```
- Deploy docker image
  - If you want your performance data to be persistent you need to create directory for them in your host:
    ```bash
    kubectl apply -f sar2html-pvc.yaml
    kubectl apply -f sar2html-deploy-persistent.yaml
    ```
  - Otherwise you may directly run the image:
    ```bash
    kubectl apply -f sar2html-deploy-ephemeral.yaml
    ```
  - Expose your pod. 
  - For local installation of kubernetes (like minikube, microk8s...):
    ```bash
            kubectl apply -f sar2html-service-nodeport.yaml
    ```
  - For kubernetes which is able to use loadbalancer:
    ```bash
            kubectl apply -f sar2html-service-loadbalancer.yaml
    ```

### ON OPENSHIFT CONTAINER PLATFORM
- Download repository and enter the directory
```bash
git clone https://github.com/cemtan/sar2html.git
cd sar2html/conf/ocp
```
- On master node create template from the sar2html.yaml
```bash
oc create -f sar2html.yaml 
```
Now you may search for "SAR Database and Plotter" in Service Catalog and you may deploy sar2html through web-console.

## CREATING THE DOCKER IMAGE
- Download repository and enter the directory
```bash
git clone https://github.com/cemtan/sar2html.git
cd sar2html
```
- If you are behind proxy edit 3 lines regarding proxy in dockerile
```bash
ENV http_proxy <YOUR HTTP PROXY>
ENV https_proxy <YOUR HTTPS PROXY>
RUN pear config-set http_proxy <YOUR HTTP PROXY>
```
- If you want to build tour own image, clone repository or download source code and extract it:
```bash
sudo docker build --tag sar2html:4.0.0 .
```

## INSTALLATION ON PHYSICAL OR VIRTUAL MACHINE
-------------------
- Install 
  - python3
  - python3-dev
  - gcc
  - libc-dev
- Download repository and enter the repository
```bash
git clone https://github.com/cemtan/sar2html.git
cd sar2html
```
- Install python modules
```bash
pip3 install -r requirements.txt
```
- Run
```bash
python3 sar2html.py
```
- Open http://<ip_address_of_your_host>:5000
- Now it is ready to work.

## RECENT CHANGES
#### 4.0.0
- Leaving apache, php behind... sar2html is pure python now.
#### 3.2.2
- sar2html supports Ubuntu 20 now.
- minor fixes
#### 3.2.1
- sar2html supports Ubuntu 18 now.
- fixed some coding problems.
#### 3.1.1
- sar2html supports SLES 12 now.
#### 3.0.1
- Fixed some configuring and capturing issues (thanks to James Kenney)
#### 3.0.0
- New user interface is available.
- Added navigation tab.
#### 2.4.3
- Added Redhat 7 support.
- Fixed rare SA_DATE parsing issue (thanks to feistypenguin)
- Fixed merging new and old sar data errors caused by device removal (patched by feistypenguin)
- Fixed plotting errors caused by device removal (patched by James Kenney)
#### 2.4.2
- Solaris 11 is supported now.
- Fixed HP-UX related issues. 
#### 2.4.1
- Changed timeout settings and dependencies.
#### 2.4.0
- sar2html is able to connect servers to capture report now.
#### 2.3.3
- Error: If a server has performed a restart recently, it puts a "LINUX RESTART" entry in sar logs. When sar2ascii tries to grep out the date for a day using sar output it keys on the word "Linux". Ignoring case... so the "LINUX RESTART" entry will get globbed in with the date entry.
  - Fix: 	Fixed by James Kenney <jameswilliamkenney@gmail.com>
- Error:	Wrong argument is provided for SA_Redhat_3_b.
  - Fix:	Fixed by feisty penguin <d3athp3nguin@users.sf.net>
#### 2.3.2
- Added bookmarks to PDF file.
#### 2.3.1
- Reformatted PDF file.
#### 2.3.0
- sar2html generates PDF formatted report now.
#### 2.2.2
- Fixed bug causing "Argument list too long" error while too many devices exist.
- Added show/hide devices option to web interface. Clicking device headers hides or shows device list.
#### 2.2.1
- Make-up
#### 2.2.0
- Added delete option
#### 2.1.2
- Fixed bugs
#### 2.1.1
- Added installation note
#### 2.1.0
- Added Redhat 6 Support
- Fixed issues regarding Sles 11 Hosts
