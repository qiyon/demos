# A Service Demo

Create the file in `/etc/init.d`, then

```
cd /etc/init.d
chmod +x ss-server
update-rc.d ss-server defaults 90
```

PS: the number `90` is the priority of service. The bigger the service run later

To remove the service:

```
update-rc.d -f ss-server remove
```
