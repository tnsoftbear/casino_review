#!/bin/bash

if [ $# -eq 0 ]; then
    echo "Usage: $0 <original_image>"
    exit 1
fi

output_dir="output"
if [ ! -d "$output_dir" ]; then
    mkdir -p "$output_dir"
    echo "Created directory for output: $output_dir"
fi

original_image="$1"

convert "$original_image" -resize 180x180 "${output_dir}/apple-touch-icon_180x180.png"
convert "$original_image" -resize 152x152 "${output_dir}/apple-touch-icon_152x152.png"
convert "$original_image" -resize 144x144 "${output_dir}/apple-touch-icon_144x144.png"
convert "$original_image" -resize 120x120 "${output_dir}/apple-touch-icon_120x120.png"
convert "$original_image" -resize 114x114 "${output_dir}/apple-touch-icon_114x114.png"
convert "$original_image" -resize 76x76 "${output_dir}/apple-touch-icon_76x76.png"
convert "$original_image" -resize 72x72 "${output_dir}/apple-touch-icon_72x72.png"
convert "$original_image" -resize 60x60 "${output_dir}/apple-touch-icon_60x60.png"

convert "$original_image" -resize 192x192 "${output_dir}/favicon_192x192.png"
convert "$original_image" -resize 96x96 "${output_dir}/favicon_96x96.png"
convert "$original_image" -resize 32x32 "${output_dir}/favicon_32x32.png"
convert "$original_image" -resize 16x16 "${output_dir}/favicon_16x16.png"

convert "$original_image" -resize 48x48 "${output_dir}/favicon.ico"

convert "$original_image" -resize 250x250 "${output_dir}/logo_250x250.png"

convert "$original_image" -resize 260x260 "${output_dir}/mask-icon_260x260.svg"

convert "$original_image" -resize 192x192 "${output_dir}/android-chrome_192x192.png"
convert "$original_image" -resize 144x144 "${output_dir}/android-chrome_144x144.png"
convert "$original_image" -resize 96x96 "${output_dir}/android-chrome_96x96.png"
convert "$original_image" -resize 72x72 "${output_dir}/android-chrome_72x72.png"
convert "$original_image" -resize 48x48 "${output_dir}/android-chrome_48x48.png"
convert "$original_image" -resize 36x36 "${output_dir}/android-chrome_36x36.png"

echo "Conversion complete!"

# sudo pacman -Sy imagemagick potrace
# ~/coding/my-repo/casino_review/infra/tool/img/resize.sh chip-red-orig.png
# mv ./output/* ~/coding/my-repo/casino_review/workspace/public/i/ico/