#!/bin/bash
chown -R root:workspace /scripts
chmod -R 0750 /scripts

exec "$@"
