// Render 1200x630 featured images for guide posts.
// Usage: node render-featured.js  (edits the GUIDES list below)
const { chromium } = require('playwright');
const fs = require('fs');
const path = require('path');
const FONTS = '/home/user/balloonprime/testmatik/assets/fonts';
const OUT = path.join(__dirname, 'featured');

const TONES = {
  sky: { c: '#0284c7', s: '#dbeefc' },
  emerald: { c: '#059669', s: '#dcf5ea' },
  indigo: { c: '#4f46e5', s: '#e5e7ff' },
  amber: { c: '#c26a04', s: '#fcefd9' },
  violet: { c: '#7c3aed', s: '#efe7ff' },
  rose: { c: '#e11d48', s: '#ffe4ea' },
};

// Phone with a blocked camera: works for any "camera won't open" guide.
function phoneCamera(c) {
  return `
  <circle cx="280" cy="280" r="230" fill="${c.s}" opacity=".75"/>
  <rect x="170" y="70" width="220" height="420" rx="36" fill="#0b1020"/>
  <rect x="184" y="96" width="192" height="368" rx="22" fill="#111a33"/>
  <circle cx="280" cy="84" r="6" fill="#334155"/>
  <g transform="translate(280 270)">
    <rect x="-62" y="-40" width="124" height="86" rx="18" fill="none" stroke="#e2e8f0" stroke-width="10"/>
    <rect x="-24" y="-56" width="48" height="18" rx="6" fill="#e2e8f0"/>
    <circle r="24" fill="none" stroke="#e2e8f0" stroke-width="10"/>
    <path d="M-80 -70 L80 70" stroke="${c.c}" stroke-width="14" stroke-linecap="round"/>
  </g>
  <g transform="translate(410 150)">
    <circle r="46" fill="#fff" stroke="#e2e8f0" stroke-width="3"/>
    <path d="M0 -20 V6" stroke="${c.c}" stroke-width="10" stroke-linecap="round"/>
    <circle cy="22" r="6" fill="${c.c}"/>
  </g>`;
}

const ART = { phoneCamera };

const GUIDES = [
  ['telefonda-kamera-acilmiyor', 'sky', 'phoneCamera', 'Telefonda kamera', 'açılmıyor?', 'Android için izin, önbellek ve donanım kontrolü adım adım.', 'Kamera rehberi'],
  ['iphone-kamera-acilmiyor', 'indigo', 'phoneCamera', 'iPhone kamera', 'açılmıyor?', 'Siyah ekran, ön kamera ve Face ID sorunları için çözümler.', 'Kamera rehberi'],
];

const logo = `<svg width="48" height="48" viewBox="0 0 32 32"><defs><linearGradient id="lg" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#22c55e"/><stop offset="1" stop-color="#0ea5e9"/></linearGradient></defs><rect x="2" y="2" width="28" height="28" rx="8" fill="url(#lg)"/><path d="m10.5 15.5 3.8 3.8 7.2-8" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>`;

function html(tone, art, a, b, sub, pill) {
  const c = TONES[tone];
  return `<!doctype html><html><head><meta charset="utf-8"><style>
@font-face{font-family:Jakarta;src:url(file://${FONTS}/jakarta-latin.woff2) format("woff2");font-weight:200 800;unicode-range:U+0000-00FF,U+0131,U+2000-206F}
@font-face{font-family:Jakarta;src:url(file://${FONTS}/jakarta-latin-ext.woff2) format("woff2");font-weight:200 800;unicode-range:U+0100-02BA,U+1E00-1EFF}
*{margin:0;box-sizing:border-box}
body{width:1200px;height:630px;overflow:hidden;font-family:Jakarta;position:relative;background:#f7f8fb;color:#0b1020}
.bg{position:absolute;inset:0;background:radial-gradient(circle at 0% 0%,${c.s} 0,transparent 50%),radial-gradient(circle at 100% 100%,${c.s} 0,transparent 50%),#f7f8fb}
.top{position:absolute;left:0;right:0;top:0;height:10px;background:linear-gradient(90deg,#10b981,#06b6d4,#6366f1)}
.l{position:absolute;left:70px;top:70px;width:540px;display:flex;flex-direction:column;gap:22px}
.pill{align-self:flex-start;padding:9px 20px;border-radius:99px;background:${c.c};color:#fff;font-weight:800;font-size:22px}
h1{font-size:70px;line-height:1.04;letter-spacing:-.045em;font-weight:800}
h1 span{background:linear-gradient(105deg,#047857,#0e7490 48%,#4338ca);-webkit-background-clip:text;color:transparent}
p{font-size:27px;line-height:1.35;color:#3d4560;font-weight:600}
.brand{position:absolute;left:70px;bottom:52px;display:flex;align-items:center;gap:14px;font-size:32px;font-weight:800;letter-spacing:-.02em}
.brand b{background:linear-gradient(105deg,#047857,#0e7490 48%,#4338ca);-webkit-background-clip:text;color:transparent}
.art{position:absolute;right:20px;top:35px;width:560px;height:560px}
</style></head><body><div class="bg"></div><div class="top"></div>
<div class="l"><span class="pill">${pill}</span><h1>${a} <span>${b}</span></h1><p>${sub}</p></div>
<div class="brand">${logo}<span>Test<b>matik</b></span></div>
<svg class="art" viewBox="0 0 560 560" xmlns="http://www.w3.org/2000/svg">${ART[art](c)}</svg>
</body></html>`;
}

(async () => {
  fs.mkdirSync(OUT, { recursive: true });
  const b = await chromium.launch();
  const p = await b.newPage({ viewport: { width: 1200, height: 630 } });
  for (const [slug, tone, art, a, bb, sub, pill] of GUIDES) {
    const tmp = path.join(OUT, 'tmp.html');
    fs.writeFileSync(tmp, html(tone, art, a, bb, sub, pill));
    await p.goto('file://' + tmp, { waitUntil: 'load' });
    await p.waitForTimeout(300);
    await p.screenshot({ path: path.join(OUT, slug + '.jpg'), type: 'jpeg', quality: 88 });
    console.log('rendered', slug);
  }
  fs.unlinkSync(path.join(OUT, 'tmp.html'));
  await b.close();
})();
