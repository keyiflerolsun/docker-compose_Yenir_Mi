#!/bin/bash
# * Bu araç @keyiflerolsun tarafından | @KekikAkademi için yazılmıştır.

# Bu betik MongoDB veritabanının yedeklemesini alır ve sıkıştırır.
MongoUser="keyiflerolsun"
MongoPass="sifre"

# Geçerli zamanı alın ve kullanılabilir bir biçimde biçimlendirin
ZAMAN=$(TZ=":Europe/Istanbul" date "+%d-%m-%Y_%H-%M-%S")

# Yedeklerin kaydedileceği dizin
DIZIN="MongoYedek"

# Eğer dizin yoksa, oluşturun
if [ ! -d "$DIZIN" ]; then
    mkdir "$DIZIN"
fi

# MongoDB'den mongodump komutunu kullanarak veritabanı yedeği alın
docker exec -t mongodb mongodump \
    --username $MongoUser --password $MongoPass \
    --out /tmp/$DIZIN

# Geçici olarak oluşturulan yedeğin gereksiz kısmını silin
docker exec -t mongodb rm -rf /tmp/$DIZIN/admin

# Yedeği kaydedilecek dizine kopyalayın
docker cp mongodb:/tmp/$DIZIN $DIZIN/$ZAMAN

# Kopyalanan yedeği silin
docker exec -t mongodb rm -rf /tmp/$DIZIN

# Yedeklenen dosyaları sıkıştırın
echo "Sıkıştırılıyor..."
tar -czvf "$ZAMAN.tar.gz" $DIZIN/$ZAMAN

# Sıkıştırılan dosyaların kopyasını silin
rm -rf $DIZIN

# Sıkıştırma işlemi tamamlandı mesajını gösterin
echo "$ZAMAN.tar.gz oluşturuldu"