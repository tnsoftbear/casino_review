if [[ -n $DEBUG ]]; then
    set -x
    PS4=": "
fi

if [ -n "$1" ]; then
    DIR="${1%/}/"
fi
POSTGRES_USER=$(docker exec -t docker-db-1 env | grep POSTGRES_USER | cut -d= -f2 | tr -d '[:space:]')
POSTGRES_DB=$(docker exec -t docker-db-1 env | grep POSTGRES_DB | cut -d= -f2 | tr -d '[:space:]')
CURRENT_DATE=$(date +"%Y_%m_%d_%H_%M_%S")
DUMP_FILE="${DIR}${POSTGRES_DB}_${CURRENT_DATE}.tar"
docker exec docker-db-1 pg_dump -U $POSTGRES_USER -d $POSTGRES_DB -Ft > $DUMP_FILE
echo "\"${POSTGRES_DB}\" db is dumped to \"${DUMP_FILE}\""
