/**
 * Generates 256×256 author avatars (initials on a brand gradient).
 * Usage: node tools/avatars.js <theme-dir>
 */
const { chromium } = require('playwright');
const fs = require('fs');
const path = require('path');
const themeDir = process.argv[2];
const out = path.join(themeDir, 'assets/avatars');
fs.mkdirSync(out, { recursive: true });
const font = fs.readFileSync(path.join(themeDir, 'assets/fonts/geist-latin.woff2')).toString('base64');
const people = {
  'emily-carter': ['EC', '#6d4bff', '#e0479e'],
  'james-walker': ['JW', '#0b8ad9', '#6d4bff'],
  'daniel-brooks': ['DB', '#ff8a4c', '#e0479e'],
  'olivia-bennett': ['OB', '#d63d8f', '#ffb547'],
};
(async () => {
  const b = await chromium.launch({ executablePath: '/opt/pw-browsers/chromium-1194/chrome-linux/chrome' });
  const p = await b.newPage({ viewport: { width: 256, height: 256 } });
  for (const [slug, [ini, a, c]] of Object.entries(people)) {
    await p.setContent(`<html><head><style>@font-face{font-family:G;src:url(data:font/woff2;base64,${font}) format('woff2');font-weight:300 800}
      body{margin:0;width:256px;height:256px;display:grid;place-items:center;background:linear-gradient(135deg,${a},${c});font-family:G;overflow:hidden;position:relative}
      body::before{content:"";position:absolute;width:220px;height:220px;border-radius:50%;left:-60px;top:-80px;background:rgba(255,255,255,.18);filter:blur(10px)}
      body::after{content:"";position:absolute;width:180px;height:180px;border-radius:50%;right:-70px;bottom:-70px;background:rgba(0,0,0,.12);filter:blur(12px)}
      span{position:relative;color:#fff;font-size:100px;font-weight:650;letter-spacing:-.04em;text-shadow:0 4px 20px rgba(0,0,0,.18)}</style></head><body><span>${ini}</span></body></html>`);
    await p.evaluate(() => document.fonts.ready);
    await p.screenshot({ path: path.join(out, slug + '.png') });
  }
  await b.close();
  console.log('avatars', fs.readdirSync(out));
})();
