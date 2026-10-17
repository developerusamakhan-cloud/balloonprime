#!/usr/bin/env bash
# Build dist/testmatik.zip. Usage: tools/build-zip.sh [patch|minor|major|none]
set -euo pipefail
cd "$(dirname "$0")/.."
BUMP="${1:-patch}"
CUR=$(grep -m1 '^Version:' style.css | awk '{print $2}')
IFS=. read -r MA MI PA <<<"$CUR"
case "$BUMP" in
	major) NEW="$((MA+1)).0.0" ;;
	minor) NEW="$MA.$((MI+1)).0" ;;
	patch) NEW="$MA.$MI.$((PA+1))" ;;
	none)  NEW="$CUR" ;;
	*) echo "Unknown bump: $BUMP"; exit 1 ;;
esac
sed -i "s/^Version: .*/Version: $NEW/" style.css
for f in $(find . -name '*.php' -not -path './dist/*'); do php -l "$f" >/dev/null; done
mkdir -p dist
TMP=$(mktemp -d)
mkdir "$TMP/testmatik"
cp -a . "$TMP/testmatik/"
rm -rf "$TMP/testmatik/dist" "$TMP/testmatik/tools" "$TMP"/testmatik/.git*
rm -f dist/testmatik.zip
(cd "$TMP" && zip -qr9 testmatik.zip testmatik)
mv "$TMP/testmatik.zip" dist/testmatik.zip
rm -rf "$TMP"
echo "Built dist/testmatik.zip (version $NEW)"
