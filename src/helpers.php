<?php

function createId(): string {
  $timestamp = base_convert((string) floor(microtime(true) * 1000), 10, 36);
  $random = substr(bin2hex(random_bytes(8)), 0, 23 - strlen($timestamp));

  return 'c'.str_pad($timestamp, 8, '0', STR_PAD_LEFT).$random;
}

function getConfig() {
  $configPath = dirname(__DIR__).'/app/config.php';
  if (!file_exists($configPath)) {
    throw new Exception("Configuration file not found at {$configPath}");
  }

  return require $configPath;
}

function vite_entry_client() {
  $config = getConfig();
  if ('production' === $config['app']['env']) {
    return '';
  }

  return '<script type="module" src="'.$config['app']['viteUrl'].'/@vite/client"></script>';
}

function vite_entry_script(string $entryName, string $ext = 'ts'): string {
  $config = getConfig();

  $jsPath = $config['app']['viteUrl'].'/resources/js/'.$entryName.'.'.$ext;
  if ('production' === $config['app']['env']) {
    $manifest = getManifest();
    $jsPath = '/build/'.$manifest['resources/js/'.$entryName]['file'];
  }

  return '<script type="module" src="'.$jsPath.'"></script>';
}

function vite_entry_link(string $entryName, string $ext = 'css'): string {
  $config = getConfig();

  $cssPath = $config['app']['viteUrl'].'/resources/css/'.$entryName.'.'.$ext;
  if ('production' === $config['app']['env']) {
    $manifest = getManifest();
    $cssPath = '/build/'.$manifest['resources/js/'.$entryName]['css'][0];
  }

  return '<link rel="stylesheet" href="'.$cssPath.'">';
}

function getManifest(): array {
  $manifestPath = dirname(__DIR__).'/public/build/.vite/manifest.json';
  if (!file_exists($manifestPath)) {
    throw new Exception("Vite manifest file not found at {$manifestPath}");
  }

  $manifest = json_decode(file_get_contents($manifestPath), true);
  $newManifest = [];
  foreach ($manifest as $key => $value) {
    $newManifest[preg_replace('/\.[^.\/]+$/', '', $key)] = $value;
  }

  return $newManifest;
}
