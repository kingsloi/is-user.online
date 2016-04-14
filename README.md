# Are You Online?

![Is kingsley online?](http://i.imgur.com/y6JwjAI.png "Is Kingsley Online?")

Do you work remotely? Are you in a different timezone? Do your colleagues know if you're online? Mine didn't, so I made this simple app to keep them updated.

To achieve this, I ping a given url every _x_ minutes, which updates a timestamp on the server (sort of like a heart beat) and if the timestamp hasn't been updated within a given time period, then you're most likely offline.

To top it off, it's wrapped into a lovely OSX app so no awkawrd/complicated instructions, just download and run.

## Installation
### OSX Application
  - Download the app for your OS from https://github.com/kingsloi/iskingsley.online/releases
  - Move the unzipped `.app`/`.exe` file to your `/Applications` folder
  - Run it
  - It's windowless and menuless, and only appears in the tray. Look for the lightbulb
  - Click Settings
  - Set your URL endpoint and a interval to ping

### PHP Endpoint
  - Edit the `index.php` with your details
  - Upload it to your webserver
  - Create a `password.txt` and a `last_updated.txt` somewhere **outside** of the webroot (so they're not publicly accessible). Updating the paths in the `index.php` if necessary.
  - Make both txt files writable
  - Create a random password in `password.txt`
  - Test it in your browser by going to [http://your_url.com?password=your_password](http://your_url.com?password=your_password)

## People using it
_Using it? Share your site! Fork it, edit this readme, add your site/author, and submit a pull request!_
- [http://iskingsley.online](http://iskingsley.online)
- [http://http://isandrea.online](http://isandrea.online)
- [http://isdavid.online](http://isdavid.online)

## Contributing
   - Contributions are welcome!
   - Pull down, edit, and submit a Pull Request
   - [https://github.com/nwjs/nw.js](https://github.com/nwjs/nw.js) is used to pack the web app into OS apps. See src/build-command for how to build it

## License
The code in this repo uses the MIT license, see our LICENSE file.
