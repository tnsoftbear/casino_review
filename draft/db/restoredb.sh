[[ -n $DEBUG ]] && set -x

POSTGRES_USER=$(docker exec -t docker-db-1 env | grep POSTGRES_USER | cut -d= -f2 | tr -d '[:space:]')
POSTGRES_DB=$(docker exec -t docker-db-1 env | grep POSTGRES_DB | cut -d= -f2 | tr -d '[:space:]')
DUMP_FILE=$1
if [[ "$DUMP_FILE" == "" ]]; then
	echo "Run: $0 <dump_file>"
	exit 1
elif [[ ! -e "$DUMP_FILE" ]]; then
	echo "Error: file \"$DUMP_FILE\" absent"
	exit 1
elif [[ ! -s "$DUMP_FILE" ]]; then
	echo "Error: file \"$DUMP_FILE\" empty"
	exit 1
fi

docker exec -i docker-db-1 pg_restore -U $POSTGRES_USER -d $POSTGRES_DB -c -Ft < $DUMP_FILE
echo "\"${POSTGRES_DB}\" db restored"
