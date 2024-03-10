# 🐳 docker compose Yenir Mi?

*Bu depo **temel olarak** `Docker` ve `docker compose` kullanımına örnek teşkil etmesi amacıyla oluşturulmuştur.*

## 🎛 Akış Diyagramı

 - `docker compose up -d`
	 - *Python Flask API* ve *PHP Arayüz*ün ortak kullanacağı `local` adında bir ağ başlatır.
		 - `urunapi_py`
			 - `UrunAPI_PY` dizinindeki `Dockerfile`'ı derler ve çalıştırır. » `restart=always`
			 - Yereldeki `UrunAPI_PY` dizinini konteyner içine bağlar.
			 - Konteyner içerisinde `5000` portundan yayın yapan *Python Flask API*'ı yerelde `3310` portuna yönlendirir.
		 - `website_php`
			 - [php:apache](https://hub.docker.com/_/php) imajını çalıştırır. » `restart=always`
			 - Yereldeki `WebSite_PHP` dizinini konteyner içinde `apache`'nin çalışacağı dizine bağlar.
			 - `urunapi_py` konteyneri başladıktan sonra başlaması için bağımlılık tanımlar.
			 - Konteyner içerisinde `80` portundan yayın yapan *apache*'yi yerelde `1453` portuna yönlendirir.

## 💡 Temel Komutlar

### Başlat - Durdur - Sil

#### Compose Olmadan

```bash
# Konteyner Derle
docker build -t urunapi_py:latest UrunAPI_PY/.

# Konteyner Başlat
docker run -d --name=urunapi_py --restart=always -p 3310:5000 -v ./UrunAPI_PY:/usr/src/UrunAPI_PY urunapi_py:latest

docker run -d --name=website_php --restart=always -p 1453:80 -v ./WebSite_PHP:/var/www/html php:apache

# Konteyner Durdur
docker stop urunapi_py
docker stop website_php
```

#### Compose ile

```bash
# Compose Başlat
docker compose up -d

# Compose Yeniden Derle / Başlat
docker compose up -d --build

# Compose Durdur
docker compose down -v

# Sistemdeki Kullanılmayan Şeyleri Sil
docker system prune -a

# Compose içindeki tek bir servisi yeniden derle ve ayağa kaldır
docker compose up -d --force-recreate --no-deps --build servis_adi
```

### Gözlemle - Bağlan - Düzenle

```bash
docker ps --format 'table {{.ID}}\t{{.Names}}\t{{.Image}}\t{{.Status}}'

docker exec -it <container_id|container_name> bash
```

## 📦 Sevilen İmajlar

<details>
  <summary style="font-weight: bold; font-size: 18px">
    <b>Portainer</b>
  </summary>
  <br/>

> [portainer/portainer-ce](https://hub.docker.com/r/portainer/portainer-ce)

```bash
docker run -d --name=portainer --restart=always -p 8000:8000 -p 9000:9000 -v /var/run/docker.sock:/var/run/docker.sock -v portainer_data:/data portainer/portainer-ce:latest
```
</details>



<details>
  <summary style="font-weight: bold; font-size: 18px">
    <b>MongoDB</b>
  </summary>
  <br/>

> [mongo](https://hub.docker.com/_/mongo)

```bash
docker run -d --name mongodb --restart unless-stopped -p 27017:27017 -e MONGO_INITDB_ROOT_USERNAME=keyiflerolsun -e MONGO_INITDB_ROOT_PASSWORD=sifre mongo:latest --auth
```

#### veya

```bash
docker run -d --name=mongodb --restart=unless-stopped -p 27017:27017 mongo:latest --auth
docker exec -it mongodb mongosh
```

```mongosh
use admin
db.createUser({
    user: "keyiflerolsun",
    pwd: "sifre",
    roles: ["root", "dbAdminAnyDatabase", "clusterAdmin", {role: "dbOwner", db:"admin"}]
})
```

```bash
docker restart mongodb
```
</details>



<details>
  <summary style="font-weight: bold; font-size: 18px">
    <b>Nginx Proxy Manager</b>
  </summary>
  <br/>

> [jc21/nginx-proxy-manager](https://hub.docker.com/r/jc21/nginx-proxy-manager)

```bash
# https://nginxproxymanager.com/guide/#quick-setup
docker run -d --name=nginx-proxy-manager --restart=unless-stopped -p 80:80 -p 81:81 -p 443:443 -v /root/nginx-proxy-manager/data:/data -v /root/nginx-proxy-manager/letsencrypt:/etc/letsencrypt jc21/nginx-proxy-manager:latest
```
</details>



<details>
  <summary style="font-weight: bold; font-size: 18px">
    <b>XAMPP</b>
  </summary>
  <br/>

> [tomsik68/xampp](https://hub.docker.com/r/tomsik68/xampp)

```bash
docker run --name=myXampp --restart=always -p 41061:22 -p 41062:80 -p 41063:3306 -d -v ~/my_web_pages:/www tomsik68/xampp
docker exec -it myXampp bash
export PATH=/opt/lampp/bin:$PATH


mysql mysql
GRANT ALL ON *.* to root@'%' IDENTIFIED BY 'root';
FLUSH PRIVILEGES;


scp -P 41061 -r * root@localhost:/opt/lampp/var/mysql/keyif/.
```
</details>



<details>
  <summary style="font-weight: bold; font-size: 18px">
    <b>WireGuard</b>
  </summary>
  <br/>

> [wg-easy/wg-easy](https://github.com/wg-easy/wg-easy)

```bash
docker run -d \
  --name=wg-easy \
  -e LANG=tr \
  -e WG_HOST=🚨IP_ADRESI🚨 \
  -e PASSWORD=🚨ADMIN_SIFRESI🚨 \
  -v ~/.wg-easy:/etc/wireguard \
  -p 51820:51820/udp \
  -p 51821:51821/tcp \
  --cap-add=NET_ADMIN \
  --cap-add=SYS_MODULE \
  --sysctl="net.ipv4.conf.all.src_valid_mark=1" \
  --sysctl="net.ipv4.ip_forward=1" \
  --restart unless-stopped \
  ghcr.io/wg-easy/wg-easy
```
</details>



<details>
  <summary style="font-weight: bold; font-size: 18px">
    <b>Homarr</b>
  </summary>
  <br/>

> [ajnart/homarr](https://github.com/ajnart/homarr)

```bash
docker run -d \
  --name homarr \
  --restart unless-stopped \
  -p 7575:7575 \
  -v /var/run/docker.sock:/var/run/docker.sock \
  -v ~/homarr/configs:/app/data/configs \
  -v ~/homarr/data:/data \
  -v ~/homarr/icons:/app/public/icons \
  ghcr.io/ajnart/homarr:latest
```
</details>



<details>
  <summary style="font-weight: bold; font-size: 18px">
    <b>Dash.</b>
  </summary>
  <br/>

> [MauriceNino/dashdot](https://github.com/MauriceNino/dashdot)

```bash
docker run -d \
  --name dashdot \
  --restart=always \
  -p 3001:3001 \
  -v /:/mnt/host:ro \
  --env DASHDOT_FS_DEVICE_FILTER="sdb" \
  --env DASHDOT_NETWORK_SPEED_AS_BYTES=true \
  --privileged \
  mauricenino/dashdot
```
</details>



<details>
  <summary style="font-weight: bold; font-size: 18px">
    <b>aria2-ui</b>
  </summary>
  <br/>

> [huangzulin/aria2-ui](https://github.com/huangzulin/aria2-ui)

```bash
docker run -d \
  --name aria2-ui \
  --restart=always \
  -p 6800:6800 \
  -p 6880:80 \
  -p 6888:81 \
  -v ~/Downloads:/aria2/downloads \
  huangzulin/aria2-ui
```
</details>


<details>
  <summary style="font-weight: bold; font-size: 18px">
    <b>NextCloud</b>
  </summary>
  <br/>

> [nextcloud/docker](https://github.com/nextcloud/docker)

```bash
version: '2'

volumes:
  nextcloud:
  db:

services:
  db:
    image: mariadb:10.6
    restart: always
    command: --transaction-isolation=READ-COMMITTED --log-bin=binlog --binlog-format=ROW
    volumes:
      - db:/var/lib/mysql
    environment:
      - MYSQL_ROOT_PASSWORD=🚨🚨🚨🚨🚨🚨
      - MYSQL_PASSWORD=🚨🚨🚨🚨🚨🚨
      - MYSQL_DATABASE=nextcloud
      - MYSQL_USER=nextcloud

  app:
    image: nextcloud
    restart: always
    ports:
      - 8080:80
    links:
      - db
    volumes:
      - nextcloud:/var/www/html
    environment:
      - MYSQL_PASSWORD=🚨🚨🚨🚨🚨🚨
      - MYSQL_DATABASE=nextcloud
      - MYSQL_USER=nextcloud
      - MYSQL_HOST=db
```

> [CLI Client](https://docs.nextcloud.com/desktop/latest/advancedusage.html#nextcloud-command-line-client)

</details>