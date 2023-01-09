@ECHO OFF
docker build . -t omeka_s_herkul
docker tag omeka_s_herkul registry.docker.libis.be/omeka_s_herkul
docker push registry.docker.libis.be/omeka_s_herkul
ECHO Image built, tagged and pushed succesfully
PAUSE
