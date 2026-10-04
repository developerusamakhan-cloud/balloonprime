/**
 * Generates 1200×630 social share images for the Lumi Pix theme.
 * Usage: node tools/og-images.js <tools.json> <theme-dir>
 * Output: <theme-dir>/assets/og/{home,tool-<key>,post-<slug>}.jpg
 */
const { chromium } = require('playwright');
const fs = require('fs');
const path = require('path');

const [toolsJson, themeDir, mode, customOut] = process.argv.slice(2);
const SQUARE = mode === 'square';
const W = SQUARE ? 1080 : 1200;
const H = SQUARE ? 1080 : 630;
const tools = JSON.parse(fs.readFileSync(toolsJson, 'utf8'));
const outDir = customOut || path.join(themeDir, 'assets/og');
fs.mkdirSync(outDir, { recursive: true });
const fontUrl = (f) => 'data:font/woff2;base64,' + fs.readFileSync(path.join(themeDir, 'assets/fonts', f)).toString('base64');

const TONES = {
  compress: { a: '#8b74ff', b: '#c04bf2', label: 'Compress' },
  resize: { a: '#3fb5ff', b: '#6d4bff', label: 'Resize' },
  background: { a: '#ff6aa8', b: '#ffb547', label: 'Background' },
};
const esc = (s) => String(s).replace(/[&<>"]/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]));

const logo = `<svg width="56" height="56" viewBox="0 0 32 32"><defs><linearGradient id="g" x1="0" y1="0" x2="32" y2="32" gradientUnits="userSpaceOnUse"><stop stop-color="#6D4BFF"/><stop offset=".55" stop-color="#E0479E"/><stop offset="1" stop-color="#FFB547"/></linearGradient></defs><rect width="32" height="32" rx="9" fill="url(#g)"/><rect x="8" y="8" width="7" height="7" rx="2" fill="#fff"/><rect x="17" y="8" width="7" height="7" rx="2" fill="#fff" fill-opacity=".55"/><rect x="8" y="17" width="7" height="7" rx="2" fill="#fff" fill-opacity=".55"/><circle cx="20.5" cy="20.5" r="3.5" fill="#fff"/></svg>`;

function page({ kicker, title, sub, tone, icon, serif }) {
  const t = TONES[tone] || TONES.compress;
  const len = title.length;
  const size = SQUARE ? (len > 70 ? 66 : len > 52 ? 74 : len > 36 ? 82 : 92) : (len > 70 ? 54 : len > 52 ? 62 : len > 36 ? 70 : 80);
  return `<!doctype html><html><head><meta charset="utf-8"><style>
@font-face{font-family:Geist;src:url('${fontUrl('geist-latin.woff2')}') format('woff2');font-weight:300 800}
@font-face{font-family:IS;src:url('${fontUrl('instrument-serif-italic-latin.woff2')}') format('woff2');font-style:italic}
*{box-sizing:border-box;margin:0}
body{width:${W}px;height:${H}px;overflow:hidden;background:#0b0b14;color:#fff;font-family:Geist,sans-serif;position:relative}
.glow1{position:absolute;width:760px;height:560px;left:-180px;top:-260px;border-radius:50%;background:${t.a};opacity:.45;filter:blur(120px)}
.glow2{position:absolute;width:640px;height:520px;right:-220px;bottom:-300px;border-radius:50%;background:${t.b};opacity:.35;filter:blur(120px)}
.grid{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.05) 1px,transparent 1px);background-size:60px 60px;-webkit-mask-image:radial-gradient(ellipse 80% 80% at 30% 20%,#000 30%,transparent 80%)}
.wrap{position:absolute;inset:0;padding:64px 72px;display:flex;flex-direction:column}
.brand{display:flex;align-items:center;gap:16px;font-size:34px;font-weight:680;letter-spacing:-.03em}
.kicker{margin-top:auto;display:inline-flex;align-self:flex-start;align-items:center;gap:10px;padding:8px 18px;border-radius:999px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.18);font-size:22px;font-weight:560;color:rgba(255,255,255,.9)}
.kicker i{width:10px;height:10px;border-radius:50%;background:${t.a};display:block}
h1{margin-top:22px;font-size:${size}px;line-height:1.06;letter-spacing:-.035em;font-weight:660;max-width:${SQUARE ? 936 : (icon ? 800 : 1040)}px}
h1 em{font-family:IS,serif;font-style:italic;font-weight:400;background:linear-gradient(115deg,#a58bff,#ff7cc1 60%,#ffb547);-webkit-background-clip:text;color:transparent}
.sub{margin-top:20px;font-size:25px;color:rgba(255,255,255,.7);max-width:880px;line-height:1.35}
.foot{margin-top:34px;display:flex;justify-content:space-between;align-items:center;font-size:22px;color:rgba(255,255,255,.65)}
.foot b{color:#fff;font-weight:600}
.badge{display:flex;gap:22px}
.badge span{display:flex;align-items:center;gap:8px}
.badge span::before{content:"";width:8px;height:8px;border-radius:50%;background:#3ccf91}
.tile{position:absolute;right:72px;top:${SQUARE ? 64 : 150}px;width:200px;height:200px;border-radius:52px;display:grid;place-items:center;color:#fff;background:linear-gradient(140deg,${t.a},${t.b});box-shadow:0 30px 80px -20px ${t.a}}
.tile svg{width:96px;height:96px;stroke-width:1.6}
</style></head><body><div class="glow1"></div><div class="glow2"></div><div class="grid"></div>
${icon ? `<div class="tile">${icon}</div>` : ''}
<div class="wrap"><div class="brand">${logo}Lumi Pix</div>
<span class="kicker"><i></i>${esc(kicker)}</span>
<h1>${serif ? title : esc(title)}</h1>${sub ? `<p class="sub">${esc(sub)}</p>` : ''}
<div class="foot"><span><b>lumipix.tools</b></span><span class="badge"><span>Free</span><span>Private</span><span>No signup</span></span></div></div></body></html>`;
}

function frontMatter(file) {
  const s = fs.readFileSync(file, 'utf8');
  const m = /^---\n([\s\S]*?)\n---\n/.exec(s);
  const meta = {};
  if (m) m[1].split('\n').forEach((l) => { const k = /^([a-z_]+):\s*(.*)$/.exec(l); if (k) meta[k[1]] = k[2].trim(); });
  return meta;
}

(async () => {
  const browser = await chromium.launch({ executablePath: '/opt/pw-browsers/chromium-1194/chrome-linux/chrome' });
  const p = await browser.newPage({ viewport: { width: W, height: H } });
  const shoot = async (html, name) => {
    await p.setContent(html, { waitUntil: 'load' });
    await p.evaluate(() => document.fonts.ready);
    await p.screenshot({ path: path.join(outDir, name + '.jpg'), type: 'jpeg', quality: 86 });
  };

  await shoot(page({ kicker: 'Free image tools', title: 'Image tools that <em>never</em> upload your photos', serif: true, sub: 'Compress to an exact KB size, resize for print and social, remove backgrounds with on-device AI.', tone: 'compress' }), 'home');

  for (const [key, t] of Object.entries(tools)) {
    await shoot(page({ kicker: 'Free tool · ' + (TONES[t.group] || TONES.compress).label, title: t.h1, sub: t.lead, tone: t.group, icon: t.svg }), 'tool-' + key);
  }

  const postsDir = path.join(themeDir, 'content/posts');
  for (const f of fs.readdirSync(postsDir).filter((x) => x.endsWith('.md')).sort()) {
    const meta = frontMatter(path.join(postsDir, f));
    const slug = f.replace(/\.md$/, '').replace(/^\d+-/, '');
    const tool = tools[meta.tool] || {};
    await shoot(page({ kicker: 'Guide · ' + (meta.category || 'Lumi Pix'), title: meta.title, tone: tool.group || 'compress', icon: tool.svg }), 'post-' + slug);
  }
  await browser.close();
  console.log('done', fs.readdirSync(outDir).length, 'images');
})();
