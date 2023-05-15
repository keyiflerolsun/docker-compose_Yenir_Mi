#!/bin/bash
# * Bu araç @keyiflerolsun tarafından | @KekikAkademi için yazılmıştır.

# Bu betik MongoDB veritabanının yedeğini geri yükler.
MongoUser="keyiflerolsun"
MongoPass="sifre"

# Yedek dosyası parametresini alın
YEDEK_DOSYASI="$1"

# Yedek dosyasını çıkartın ve mevcut dizine yerleştirin
tar -xzvf $YEDEK_DOSYASI -C .

# Yedek dosyasının tarih bilgisini alın
TARIH=$(echo $YEDEK_DOSYASI | grep -oP '\d{2}-\d{2}-\d{4}_\d{2}-\d{2}-\d{2}')

# Yedek yükleme işlemi başladı mesajını gösterin
echo "$TARIH Tarihli yedeği yüklüyorum."

# Yedek dosyasını MongoDB konteynırına kopyalayın
docker cp MongoYedek/$TARIH mongodb:/tmp/$TARIH

# MongoDB konteynırında mongorestore komutunu kullanarak yedek dosyasını geri yükleyin
docker exec -i mongodb mongorestore --authenticationDatabase=admin \
    --username $MongoUser --password $MongoPass \
    --verbose /tmp/$TARIH

# Kopyalanan yedek dosyasını silin
docker exec -t mongodb rm -rf /tmp/$TARIH

# Yereldeki yedek dosyasını ve klasörünü silin
rm -rf MongoYedek

# Yedek yükleme işlemi tamamlandı mesajını gösterin
echo "Yüklemeler tamamlandı."