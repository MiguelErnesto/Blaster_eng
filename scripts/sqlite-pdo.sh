#!/usr/bin/env bash
# Prefer distro libsqlite3 so PHP pdo_sqlite can load.
# A custom /usr/local/lib/libsqlite3.so often lacks sqlite3_column_table_name.
export LD_LIBRARY_PATH="/lib/x86_64-linux-gnu${LD_LIBRARY_PATH:+:$LD_LIBRARY_PATH}"
exec "$@"
