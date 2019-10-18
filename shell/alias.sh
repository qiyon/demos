alias pxon="export http_proxy=http://127.0.0.1:10807; export https_proxy=http://127.0.0.1:10807; echo 'HTTP Proxy on';"
alias pxoff="unset http_proxy; unset https_proxy; echo 'HTTP Proxy off';"

alias ltcp="lsof -iTCP -sTCP:LISTEN -nP"
alias ludp="lsof -iUDP -nP"

