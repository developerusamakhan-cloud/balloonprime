// Render the Klavye Hız Testi pin (1000x1500) and featured image (1200x630),
// and patch pin 06 so its frequency range uses a plain hyphen instead of a dash.
const { chromium } = require('playwright');
const fs = require('fs');
const path = require('path');
const FONTS = '/home/user/balloonprime/testmatik/assets/fonts';
const OUT = __dirname;

const C = { c: '#0284c7', s: '#dbeefc', d: '#0b1020', k: '#1e293b' };
const logo = `<svg width="56" height="56" viewBox="0 0 32 32"><defs><linearGradient id="lg" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#22c55e"/><stop offset="1" stop-color="#0ea5e9"/></linearGradient></defs><rect x="2" y="2" width="28" height="28" rx="8" fill="url(#lg)"/><path d="m10.5 15.5 3.8 3.8 7.2-8" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>`;
const check = `<svg width="34" height="34" viewBox="0 0 24 24"><circle cx="12" cy="12" r="11" fill="#047857"/><path d="m7 12.5 3.2 3.2L17 9" fill="none" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg>`;

const fontCss = `
@font-face{font-family:Jakarta;src:url(file://${FONTS}/jakarta-latin.woff2) format("woff2");font-weight:200 800;unicode-range:U+0000-00FF,U+0131,U+2000-206F}
@font-face{font-family:Jakarta;src:url(file://${FONTS}/jakarta-latin-ext.woff2) format("woff2");font-weight:200 800;unicode-range:U+0100-02BA,U+1E00-1EFF}
@font-face{font-family:Mono;src:url(file://${FONTS}/jbmono-latin.woff2) format("woff2");font-weight:100 800}`;

// Keyboard, stopwatch and a result bubble.
function art() {
  let keys = '';
  const rows = [[0, 12], [14, 11], [28, 10]];
  rows.forEach(([off, n], r) => {
    for (let i = 0; i < n; i++) {
      const hot = (r === 1 && (i === 3 || i === 6)) || (r === 0 && i === 2) || (r === 2 && i === 5);
      keys += `<rect x="${62 + off + i * 36}" y="${352 + r * 40}" width="30" height="32" rx="7" fill="${hot ? C.c : '#334155'}"/>`;
    }
  });
  keys += `<rect x="150" y="472" width="260" height="30" rx="7" fill="#334155"/>`;
  return `
  <circle cx="290" cy="270" r="230" fill="${C.s}" opacity=".7"/>
  <circle cx="470" cy="110" r="52" fill="${C.s}"/>
  <rect x="44" y="334" width="472" height="186" rx="26" fill="${C.d}"/>${keys}
  <g transform="translate(150 175)">
    <rect x="-14" y="-118" width="28" height="22" rx="6" fill="${C.d}"/>
    <circle r="96" fill="#fff" stroke="${C.d}" stroke-width="14"/>
    <path d="M0 0 L0 -62" stroke="${C.c}" stroke-width="10" stroke-linecap="round"/>
    <path d="M0 0 L44 26" stroke="${C.d}" stroke-width="10" stroke-linecap="round"/>
    <circle r="12" fill="${C.d}"/>
  </g>
  <g transform="translate(300 96)">
    <rect width="232" height="128" rx="26" fill="#fff" stroke="#e2e8f0" stroke-width="3"/>
    <path d="M40 126 L30 160 L76 126 Z" fill="#fff"/>
    <text x="116" y="72" text-anchor="middle" font-family="Mono" font-weight="800" font-size="60" fill="${C.c}">62</text>
    <text x="116" y="106" text-anchor="middle" font-family="Jakarta" font-weight="700" font-size="24" fill="#3d4560">kelime / dk</text>
  </g>`;
}

function pinHtml() {
  const list = ['Türkçe kelimelerle 1, 3 veya 5 dakika', 'Net kelime, vuruş ve doğruluk oranı', 'On parmak ve katiplik pratiği için'];
  return `<!doctype html><html><head><meta charset="utf-8"><style>${fontCss}
*{margin:0;box-sizing:border-box}
body{width:1000px;height:1500px;overflow:hidden;font-family:Jakarta;position:relative;background:#f7f8fb;color:#0b1020}
.bg{position:absolute;inset:0;background:radial-gradient(circle at 0% 0%,${C.s} 0,transparent 45%),radial-gradient(circle at 100% 60%,${C.s} 0,transparent 45%),#f7f8fb}
.dots{position:absolute;inset:0;background-image:radial-gradient(#d6dbe6 1.4px,transparent 1.6px);background-size:28px 28px;opacity:.55;mask-image:linear-gradient(180deg,#000 0,transparent 45%)}
.top{position:absolute;left:0;right:0;top:0;height:14px;background:linear-gradient(90deg,#10b981,#06b6d4,#6366f1)}
.wrap{position:absolute;inset:80px 72px 70px;display:flex;flex-direction:column}
.pill{align-self:flex-start;padding:12px 26px;border-radius:99px;background:${C.c};color:#fff;font-weight:800;font-size:28px}
h1{margin-top:34px;font-size:92px;line-height:1.03;letter-spacing:-.045em;font-weight:800}
h1 span{background:linear-gradient(105deg,#047857,#0e7490 48%,#4338ca);-webkit-background-clip:text;color:transparent}
.sub{margin-top:22px;font-size:36px;line-height:1.3;color:#3d4560;font-weight:600}
.art{margin:20px -20px 0;height:500px}
.list{display:flex;flex-direction:column;gap:20px;margin-top:6px}
.list div{display:flex;align-items:center;gap:18px;font-size:34px;font-weight:700}
.cta{margin-top:auto;display:flex;align-items:center;justify-content:space-between;background:#0b1020;color:#fff;border-radius:28px;padding:30px 36px}
.brand{display:flex;align-items:center;gap:16px;font-size:40px;font-weight:800;letter-spacing:-.02em}
.brand b{background:linear-gradient(105deg,#34d399,#22d3ee 48%,#818cf8);-webkit-background-clip:text;color:transparent}
.url{font-size:30px;font-weight:700;background:#fff;color:#0b1020;padding:14px 24px;border-radius:16px}
</style></head><body><div class="bg"></div><div class="dots"></div><div class="top"></div>
<div class="wrap">
<span class="pill">Ücretsiz online araç</span>
<h1>Dakikada kaç kelime <span>yazıyorsun?</span></h1>
<p class="sub">Klavye hız testi. Kayıt yok, kurulum yok.</p>
<svg class="art" viewBox="0 0 560 560" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">${art()}</svg>
<div class="list">${list.map(t => `<div>${check} ${t}</div>`).join('')}</div>
<div class="cta"><div class="brand">${logo}<span>Test<b>matik</b></span></div><span class="url">testmatik.app</span></div>
</div></body></html>`;
}

function ogHtml() {
  return `<!doctype html><html><head><meta charset="utf-8"><style>${fontCss}
*{margin:0;box-sizing:border-box}
body{width:1200px;height:630px;overflow:hidden;font-family:Jakarta;position:relative;background:#f7f8fb;color:#0b1020}
.bg{position:absolute;inset:0;background:radial-gradient(circle at 0% 0%,${C.s} 0,transparent 50%),radial-gradient(circle at 100% 100%,${C.s} 0,transparent 50%),#f7f8fb}
.top{position:absolute;left:0;right:0;top:0;height:10px;background:linear-gradient(90deg,#10b981,#06b6d4,#6366f1)}
.l{position:absolute;left:70px;top:70px;width:600px;display:flex;flex-direction:column;gap:22px}
.pill{align-self:flex-start;padding:9px 20px;border-radius:99px;background:${C.c};color:#fff;font-weight:800;font-size:22px}
h1{font-size:76px;line-height:1.02;letter-spacing:-.045em;font-weight:800}
h1 span{background:linear-gradient(105deg,#047857,#0e7490 48%,#4338ca);-webkit-background-clip:text;color:transparent}
p{font-size:28px;line-height:1.35;color:#3d4560;font-weight:600}
.brand{position:absolute;left:70px;bottom:56px;display:flex;align-items:center;gap:14px;font-size:34px;font-weight:800;letter-spacing:-.02em}
.brand b{background:linear-gradient(105deg,#047857,#0e7490 48%,#4338ca);-webkit-background-clip:text;color:transparent}
.art{position:absolute;right:30px;top:40px;width:540px;height:540px}
</style></head><body><div class="bg"></div><div class="top"></div>
<div class="l"><span class="pill">Ücretsiz online araç</span><h1>Klavye <span>Hız Testi</span></h1><p>Türkçe kelimelerle dakikada kaç kelime yazdığını ölç. Net kelime, vuruş ve doğruluk.</p></div>
<div class="brand">${logo}<span>Test<b>matik</b></span></div>
<svg class="art" viewBox="0 0 560 560" xmlns="http://www.w3.org/2000/svg">${art()}</svg>
</body></html>`;
}

// Pin 06: cover the two "20 Hz – 20 kHz" spots and redraw them with plain text.
function patchHtml() {
  const img = 'file://' + path.join(OUT, 'pin-06-hoparlor-testi.png');
  return `<!doctype html><html><head><meta charset="utf-8"><style>${fontCss}
*{margin:0;box-sizing:border-box}body{width:1000px;height:1500px;position:relative;background:url(${img}) no-repeat;font-family:Jakarta;color:#0b1020}
.lab{position:absolute;left:386px;top:871px;width:228px;height:34px;border-radius:99px;background:#fff;display:flex;align-items:center;justify-content:center;font-size:17px;font-weight:700}
.row{position:absolute;left:118px;top:1012px;width:620px;height:62px;background:linear-gradient(90deg,#f7f8fb,#f5f3fd);display:flex;align-items:center;font-size:34px;font-weight:700;letter-spacing:-.01em;padding-left:6px}
</style></head><body><div class="lab">20 Hz - 20 kHz</div><div class="row">20 Hz'den 20 kHz'e frekans taraması</div></body></html>`;
}

(async () => {
  const b = await chromium.launch();
  const jobs = [
    ['pin-07-klavye-hiz-testi.png', pinHtml(), 1000, 1500, 'png'],
    ['klavye-hiz-testi.jpg', ogHtml(), 1200, 630, 'jpeg'],
    ['pin-06-hoparlor-testi.new.png', patchHtml(), 1000, 1500, 'png'],
  ];
  for (const [file, html, w, h, type] of jobs) {
    const p = await b.newPage({ viewport: { width: w, height: h } });
    fs.writeFileSync(path.join(OUT, 'tmp-render.html'), html);
    await p.goto('file://' + path.join(OUT, 'tmp-render.html'), { waitUntil: 'load' });
    await p.waitForTimeout(400);
    await p.screenshot({ path: path.join(OUT, file), type, quality: type === 'jpeg' ? 88 : undefined });
    await p.close();
    console.log('rendered', file);
  }
  fs.unlinkSync(path.join(OUT, 'tmp-render.html'));
  await b.close();
})();
