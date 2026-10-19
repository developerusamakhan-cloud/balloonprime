// Render a 1000x1500 Pinterest pin for the keyboard test.
const { chromium } = require('playwright-core');
const fs = require('fs');
const { ILL, T } = require(process.env.ILLUS || './illus');
const FONTS = '/home/user/balloonprime/testmatik/assets/fonts';
const OUT = __dirname + '/pin-01-klavye-testi.png';
const c = T.indigo;
const logo = `<svg width="56" height="56" viewBox="0 0 32 32"><defs><linearGradient id="lg" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#22c55e"/><stop offset="1" stop-color="#0ea5e9"/></linearGradient></defs><rect x="2" y="2" width="28" height="28" rx="8" fill="url(#lg)"/><path d="m10.5 15.5 3.8 3.8 7.2-8" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>`;
const check = `<svg width="34" height="34" viewBox="0 0 24 24"><circle cx="12" cy="12" r="11" fill="#047857"/><path d="m7 12.5 3.2 3.2L17 9" fill="none" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg>`;
const html = `<!doctype html><html><head><meta charset="utf-8"><style>
@font-face{font-family:Jakarta;src:url(file://${FONTS}/jakarta-latin.woff2) format("woff2");font-weight:200 800;unicode-range:U+0000-00FF,U+0131,U+2000-206F}
@font-face{font-family:Jakarta;src:url(file://${FONTS}/jakarta-latin-ext.woff2) format("woff2");font-weight:200 800;unicode-range:U+0100-02BA,U+1E00-1EFF}
*{margin:0;box-sizing:border-box}
body{width:1000px;height:1500px;overflow:hidden;font-family:Jakarta;position:relative;background:#f7f8fb;color:#0b1020}
.bg{position:absolute;inset:0;background:radial-gradient(circle at 0% 0%,${c.s} 0,transparent 45%),radial-gradient(circle at 100% 60%,${c.s} 0,transparent 45%),#f7f8fb}
.dots{position:absolute;inset:0;background-image:radial-gradient(#d6dbe6 1.4px,transparent 1.6px);background-size:28px 28px;opacity:.55;mask-image:linear-gradient(180deg,#000 0,transparent 45%)}
.top{position:absolute;left:0;right:0;top:0;height:14px;background:linear-gradient(90deg,#10b981,#06b6d4,#6366f1)}
.wrap{position:absolute;inset:80px 72px 70px;display:flex;flex-direction:column}
.pill{align-self:flex-start;padding:12px 26px;border-radius:99px;background:${c.c};color:#fff;font-weight:800;font-size:28px}
h1{margin-top:34px;font-size:96px;line-height:1.02;letter-spacing:-.045em;font-weight:800}
h1 span{background:linear-gradient(105deg,#047857,#0e7490 48%,#4338ca);-webkit-background-clip:text;color:transparent}
.sub{margin-top:22px;font-size:36px;line-height:1.3;color:#3d4560;font-weight:600}
.art{margin:26px -20px 0;height:520px}
.list{display:flex;flex-direction:column;gap:20px;margin-top:6px}
.list div{display:flex;align-items:center;gap:18px;font-size:34px;font-weight:700}
.cta{margin-top:auto;display:flex;align-items:center;justify-content:space-between;background:#0b1020;color:#fff;border-radius:28px;padding:30px 36px}
.brand{display:flex;align-items:center;gap:16px;font-size:40px;font-weight:800;letter-spacing:-.02em}
.brand b{background:linear-gradient(105deg,#34d399,#22d3ee 48%,#818cf8);-webkit-background-clip:text;color:transparent}
.url{font-size:30px;font-weight:700;background:#fff;color:#0b1020;padding:14px 24px;border-radius:16px}
</style></head><body><div class="bg"></div><div class="dots"></div><div class="top"></div>
<div class="wrap">
<span class="pill">Ücretsiz online araç</span>
<h1>Klavyenin her tuşu <span>çalışıyor mu?</span></h1>
<p class="sub">30 saniyede test et. Program yok, kayıt yok.</p>
<svg class="art" viewBox="0 0 560 560" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">${ILL.keyboard('indigo')}</svg>
<div class="list">
<div>${check} Çalışan her tuş yeşile döner</div>
<div>${check} Türkçe Q ve F klavye düzeni</div>
<div>${check} Ghosting testi: aynı anda kaç tuş?</div>
</div>
<div class="cta"><div class="brand">${logo}<span>Test<b>matik</b></span></div><span class="url">testmatik.app</span></div>
</div></body></html>`;
(async () => {
  const b = await chromium.launch({ executablePath: '/opt/pw-browsers/chromium-1194/chrome-linux/chrome' });
  const p = await b.newPage({ viewport: { width: 1000, height: 1500 } });
  fs.writeFileSync(__dirname + '/tmp-pin.html', html);
  await p.goto('file://' + __dirname + '/tmp-pin.html', { waitUntil: 'load' });
  await p.waitForTimeout(400);
  await p.screenshot({ path: OUT });
  await b.close();
  console.log('ok');
})();
