#!/usr/bin/env bash
# Build dist/lumipix.zip for upload in Appearance → Themes → Add New → Upload.
#
# Every build bumps the theme version in style.css, so WordPress offers
# "Replace current with uploaded" and browsers load the new CSS/JS.
#
#   tools/build-zip.sh          # patch bump: 1.2.0 -> 1.2.1
#   tools/build-zip.sh minor    # minor bump: 1.2.1 -> 1.3.0
#   tools/build-zip.sh major    # major bump: 1.3.0 -> 2.0.0
#   tools/build-zip.sh keep     # build without changing the version
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
THEME="$ROOT/lumipix-theme"
STYLE="$THEME/style.css"
PART="${1:-patch}"

current="$(sed -n 's/^Version: *\([0-9][0-9.]*\).*/\1/p' "$STYLE" | head -1)"
IFS=. read -r major minor patch <<<"$current"
case "$PART" in
	major) major=$((major + 1)); minor=0; patch=0 ;;
	minor) minor=$((minor + 1)); patch=0 ;;
	patch) patch=$((patch + 1)) ;;
	keep) ;;
	*) echo "Unknown bump: $PART (use patch, minor, major or keep)" >&2; exit 1 ;;
esac
next="$major.$minor.$patch"

if [ "$next" != "$current" ]; then
	sed -i.bak "s/^Version: .*/Version: $next/" "$STYLE" && rm -f "$STYLE.bak"
	echo "Version: $current -> $next"
else
	echo "Version: $current (unchanged)"
fi

tmp="$(mktemp -d)"
trap 'rm -rf "$tmp"' EXIT
cp -R "$THEME" "$tmp/lumipix"
find "$tmp/lumipix" -name '.DS_Store' -delete
mkdir -p "$ROOT/dist"
rm -f "$ROOT/dist/lumipix.zip"
(cd "$tmp" && zip -qr "$ROOT/dist/lumipix.zip" lumipix)
echo "Built dist/lumipix.zip ($(du -h "$ROOT/dist/lumipix.zip" | cut -f1))"
