import fs from 'fs';
import path from 'path';

const srcPath = path.resolve('dist/index.html');
const destPath = path.resolve('vue.html');

if (fs.existsSync(srcPath)) {
  fs.copyFileSync(srcPath, destPath);
  console.log(`\n🎉 Successfully compiled and copied single-file build to: ${destPath}\n`);
} else {
  console.error('\n❌ Build output index.html not found!\n');
  process.exit(1);
}

// Copiar config.js para a raiz (ao lado de vue.html), permitindo edição sem recompilar
const configSrc = path.resolve('dist/config.js');
const configDest = path.resolve('config.js');
if (fs.existsSync(configSrc)) {
  fs.copyFileSync(configSrc, configDest);
  console.log(`⚙️  Runtime config copied to: ${configDest}`);
}
