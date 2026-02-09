# Portfolio — Astro + React + Tailwind

Landing/portfolio personal construido con **Astro** y componentes **React**, estilado con **Tailwind CSS**. Incluye secciones de presentación, experiencia, proyectos, conocimientos y contacto, con animaciones y efectos visuales.

## ✨ Destacados
- One‑page layout con secciones: **Hero**, **Sobre mí**, **Experiencia**, **Proyectos**, **Conocimientos**, **Contacto** y **Footer**.
- Componentes interactivos (texto brillante, presión tipográfica, fondo animado, carrusel de logos, blur gradual).
- Diseño responsive y centrado en la estética visual.
- Assets en `public/` (imágenes de proyectos, logos, CV, etc.).

## 🧰 Stack
- **Astro 5**
- **React 19**
- **Tailwind CSS 4**
- Extras: **GSAP**, **OGL**, **Motion**, **mathjs**, **react-icons**

## 📁 Estructura del proyecto
```text
public/
  ├─ afp.png
  ├─ portfolio.png
  ├─ lift.png
  ├─ aurea.png
  ├─ *.svg (logos)
  └─ cv.pdf
src/
  ├─ components/
  │  ├─ Welcome.astro      # Contenido principal y secciones
  │  ├─ Header.astro
  │  ├─ Footer.astro
  │  └─ React/              # Componentes React reutilizables
  ├─ layouts/
  │  └─ Layout.astro
  └─ pages/
     └─ index.astro
```

## 🚀 Cómo ejecutar en local
```bash
npm install
npm run dev
```
Abre `http://localhost:4321`.

## 🏗️ Build y preview
```bash
npm run build
npm run preview
```

## ✍️ Personalización rápida
- **Contenido principal:** `src/components/Welcome.astro`
- **Header:** `src/components/Header.astro`
- **Footer:** `src/components/Footer.astro`
- **Imágenes/Logos/CV:** carpeta `public/`

## ✅ Notas
- El carrusel de logos usa assets de `public/*.svg`.
- El botón de CV apunta a `public/cv.pdf`.
- La página de pruebas/experimentos está en `src/components/Prueba.astro`.

---
© Alejandro Sopeña. 