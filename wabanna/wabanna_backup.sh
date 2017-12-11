#!/bin/bash

export PATH=/opt/lampp/bin:${PATH}

/opt/lampp/bin/mysqldump --routines -u root --password="" wabanna > /root/wabanna.`date +%m%d%Y%H%M%S`.sql 2>>/root/wabanna.err

