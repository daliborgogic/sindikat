# sindikat
> Progressive Web App (PWA) 
<img src="https://i.imgur.com/7Nc7s8x.png" width="375">

### Environment Variables

| Key              | Description                                             |
|:-----------------|:--------------------------------------------------------|
| ```CMS_DOMAIN``` | Content Menagement System (CMS) Top Level Domain (TLD). |
| ```APP_DOMAIN``` | Application Top Level Domain (TLD).                     |

### Usage

```bash
# Install a package, and any packages that it depends on:
$ npm i

# Set Environment Variables:
$ cat > .env << EOL
CMS_DOMAIN=
APP_DOMAIN=
EOL

# Launch a development server on localhost:3000 with hot-reloading
$ npm run dev

# Build application with webpack
$ npm run build

# Start the server in production mode
$ npm start

# Or start the server with process manager
$ pm2 start process.json
```

### License
[MIT](https://github.com/daliborgogic/sindikat/blob/master/LICENSE)
Copyright (c) 2018-2019, Dalibor Gogic
