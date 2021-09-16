@ECHO OFF
docker build . -t omeka_s_steunpunt
docker tag omeka_s_steunpunt registry.docker.libis.be/omeka_s_steunpunt
docker push registry.docker.libis.be/omeka_s_steunpunt
ECHO Image built, tagged and pushed succesfully
PAUSE
