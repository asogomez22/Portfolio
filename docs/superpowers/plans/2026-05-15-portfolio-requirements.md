# Portfolio Requirements Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Complete the portfolio assignment requirements and prepare the site for deployment.

**Architecture:** Keep the existing Astro one-page architecture and make focused edits in `Welcome.astro`, `Header.astro`, `Footer.astro`, and `Layout.astro`. Project filtering will use static Astro-rendered data attributes plus a small inline browser script.

**Tech Stack:** Astro 5, React island components, Tailwind CSS utility classes, vanilla JavaScript for filters.

---

## File Structure

- Modify `src/components/Welcome.astro`: project metadata, filter controls, education/certificates section, `id="top"`, link fixes, filter script, accessibility attributes.
- Modify `src/components/Header.astro`: add education/certificates navigation item and observer target.
- Modify `src/components/Footer.astro`: add projects and education/certificates navigation links, fix internal links.
- Modify `src/layouts/Layout.astro`: remove the failing `lenis` import/script and use native smooth scrolling CSS.
- Verify with `npm run build`.
- Commit implementation and push to the remote branch.

---

### Task 1: Fix Build Blocker

**Files:**
- Modify: `src/layouts/Layout.astro:53-69`
- Modify: `src/layouts/Layout.astro:73-104`

- [ ] **Step 1: Remove the Lenis script**

Delete this script block from `src/layouts/Layout.astro`:

```astro
    <script>
      import Lenis from "lenis";

      const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        smoothWheel: true,
        touchMultiplier: 2,
      });

      function raf(time: number) {
        lenis.raf(time);
        requestAnimationFrame(raf);
      }

      requestAnimationFrame(raf);
    </script>
```

- [ ] **Step 2: Replace Lenis CSS with native smooth scrolling**

Replace the global style block with:

```astro
<style is:global>
  html {
    scroll-behavior: smooth;
  }

  html,
  body {
    margin: 0;
    width: 100%;
    min-height: 100%;
    overflow-x: hidden;
  }
</style>
```

- [ ] **Step 3: Verify the build blocker is gone**

Run: `npm run build`

Expected: The previous error `Rollup failed to resolve import "lenis"` no longer appears.

---

### Task 2: Add Navigation Targets

**Files:**
- Modify: `src/components/Header.astro:2-7`
- Modify: `src/components/Header.astro:206-212`
- Modify: `src/components/Footer.astro:5-11`
- Modify: `src/components/Welcome.astro:135-137`

- [ ] **Step 1: Add `id="top"` to the hero section**

Change the hero opening section to:

```astro
  <section
    id="top"
    class="relative min-h-[100svh] md:min-h-[100dvh] w-full overflow-hidden flex flex-col items-center justify-center gap-4 py-20 sm:py-24"
  >
```

- [ ] **Step 2: Add formation to header links**

Use this `links` array in `src/components/Header.astro`:

```js
const links = [
  { label: "Sobre mí", href: "#sobre" },
  { label: "Experiencia", href: "#experiencia" },
  { label: "Proyectos", href: "#proyectos" },
  { label: "Formación", href: "#formacion" },
  { label: "Conocimientos", href: "#conocimientos" },
];
```

- [ ] **Step 3: Observe formation for active nav**

Use this `sections` list in the header script:

```js
  const sections = [
    "#sobre",
    "#experiencia",
    "#proyectos",
    "#formacion",
    "#conocimientos",
    "#contacto",
  ]
```

- [ ] **Step 4: Add projects and formation to footer navigation**

Use this `nav` array in `src/components/Footer.astro`:

```js
const nav = [
  { label: "Inicio", href: "#top" },
  { label: "Sobre mí", href: "#sobre" },
  { label: "Experiencia", href: "#experiencia" },
  { label: "Proyectos", href: "#proyectos" },
  { label: "Formación", href: "#formacion" },
  { label: "Conocimientos", href: "#conocimientos" },
  { label: "Contacto", href: "#contacto" },
];
```

---

### Task 3: Add Project Filters

**Files:**
- Modify: `src/components/Welcome.astro:47-97`
- Modify: `src/components/Welcome.astro:421-498`
- Modify: `src/components/Welcome.astro:723-795`

- [ ] **Step 1: Add filter metadata**

Add this constant before `projects`:

```js
const projectFilters = [
  { label: "Todos", value: "all" },
  { label: "Full Stack", value: "full-stack" },
  { label: "Frontend", value: "frontend" },
  { label: "Backend", value: "backend" },
  { label: "Laravel", value: "laravel" },
  { label: "React", value: "react" },
  { label: "Symfony", value: "symfony" },
  { label: "Tailwind", value: "tailwind" },
];
```

- [ ] **Step 2: Add `filters` arrays to each project and fix URLs**

Ensure each project has a `filters` property:

```js
filters: ["full-stack", "frontend", "backend", "symfony", "react", "tailwind"],
```

Use appropriate categories per project:

- PlanEat: `full-stack`, `frontend`, `backend`, `symfony`, `react`, `tailwind`
- Lift Ingeniería: `full-stack`, `backend`, `laravel`, `tailwind`
- Appetite For Posts: `full-stack`, `frontend`, `backend`, `react`
- Portfolio: `frontend`, `astro`, `tailwind`
- Aurea: `full-stack`, `backend`, `laravel`, `tailwind`

Fix URLs:

- Appetite For Posts web: `https://appetiteforposts.com`
- Portfolio web: `https://asogom.es`
- Aurea web: `https://tiendaprueba.tarracowebs.com`

- [ ] **Step 3: Add filter controls above project grid**

Insert this block after the project section description and before the grid:

```astro
            <div class="mt-5 flex flex-wrap gap-2" aria-label="Filtrar proyectos">
              {
                projectFilters.map((filter) => (
                  <button
                    type="button"
                    data-project-filter={filter.value}
                    aria-pressed={filter.value === "all" ? "true" : "false"}
                    class={`rounded-full border px-3 py-1.5 text-xs font-bold transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/45 ${
                      filter.value === "all"
                        ? "border-white/35 bg-white/25 text-white"
                        : "border-white/12 bg-white/10 text-white/75 hover:bg-white/15 hover:text-white"
                    }`}
                  >
                    {filter.label}
                  </button>
                ))
              }
            </div>
```

- [ ] **Step 4: Add data attributes to project cards**

Change the project card opening tag to include:

```astro
data-project-card
data-project-filters={p.filters.join(" ")}
```

Use descriptive image alt text:

```astro
alt={`Captura del proyecto ${p.title}`}
```

- [ ] **Step 5: Add filter script**

Inside the existing browser script in `Welcome.astro`, after the CV download setup, add:

```js
    const filterButtons = Array.from(document.querySelectorAll("[data-project-filter]"));
    const projectCards = Array.from(document.querySelectorAll("[data-project-card]"));

    const setProjectFilter = (activeFilter) => {
      filterButtons.forEach((button) => {
        const isActive = button.dataset.projectFilter === activeFilter;
        button.setAttribute("aria-pressed", String(isActive));
        button.classList.toggle("border-white/35", isActive);
        button.classList.toggle("bg-white/25", isActive);
        button.classList.toggle("text-white", isActive);
        button.classList.toggle("border-white/12", !isActive);
        button.classList.toggle("bg-white/10", !isActive);
        button.classList.toggle("text-white/75", !isActive);
      });

      projectCards.forEach((card) => {
        const filters = card.dataset.projectFilters?.split(" ") ?? [];
        const shouldShow = activeFilter === "all" || filters.includes(activeFilter);
        card.classList.toggle("hidden", !shouldShow);
      });
    };

    filterButtons.forEach((button) => {
      button.addEventListener("click", () => {
        setProjectFilter(button.dataset.projectFilter || "all");
      });
    });
```

---

### Task 4: Add Education And Certificates Section

**Files:**
- Modify: `src/components/Welcome.astro:40-47`
- Modify: `src/components/Welcome.astro:501-503`

- [ ] **Step 1: Add education data**

Add this constant near the other data arrays:

```js
const educationItems = [
  {
    title: "Desarrollo de Aplicaciones Web",
    place: "Formación profesional / estudios de desarrollo web",
    date: "2024 — 2026",
    desc: "Formación centrada en desarrollo frontend, backend, bases de datos, despliegue y creación de aplicaciones web completas.",
    tags: ["HTML", "CSS", "JavaScript", "PHP", "Bases de datos"],
  },
  {
    title: "Prácticas en empresa",
    place: "Inetum",
    date: "Octubre 2025 — Abril 2026",
    desc: "Experiencia formativa en entorno profesional, trabajo en equipo y entrada a proyecto real como perfil Full Stack.",
    tags: ["Full Stack", "Equipo", "Proyecto real"],
  },
];
```

- [ ] **Step 2: Insert the formation section before knowledge**

Insert this section before `<!-- CONOCIMIENTOS -->`:

```astro
    <section id="formacion" class="relative overflow-hidden">
      <div
        aria-hidden="true"
        class="pointer-events-none absolute inset-0 z-0 opacity-20
               bg-[radial-gradient(rgba(255,255,255,0.65)_1px,transparent_1px)]
               bg-size-[18px_18px]"
      >
      </div>

      <div class="relative z-10 mx-auto max-w-6xl px-4 sm:px-6 md:px-10 py-14 sm:py-16 md:py-24">
        <header class="mx-auto max-w-3xl text-center text-white">
          <p class="mb-3 inline-flex items-center justify-center gap-2 text-xs font-semibold uppercase tracking-wider text-white/70">
            <span class="h-px w-8 sm:w-10 bg-white/30"></span>
            Formación
            <span class="h-px w-8 sm:w-10 bg-white/30"></span>
          </p>

          <h2 class="text-2xl xs:text-3xl font-extrabold leading-tight md:text-4xl">
            Formación y certificados
          </h2>

          <p class="mt-4 text-sm leading-relaxed text-white/75 md:text-base">
            Estudios, prácticas y aprendizajes relacionados con el desarrollo web.
          </p>
        </header>

        <div class="mt-10 sm:mt-12 grid gap-5 md:grid-cols-2">
          {
            educationItems.map((item) => (
              <article class="rounded-3xl border border-white/12 bg-white/10 p-5 sm:p-6 backdrop-blur-md shadow-lg shadow-black/25 transition hover:bg-white/12 hover:border-white/18">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                  <div>
                    <h3 class="text-lg font-extrabold tracking-tight text-white">{item.title}</h3>
                    <p class="mt-1 text-sm font-semibold text-white/75">{item.place}</p>
                  </div>
                  <span class="w-fit rounded-full border border-white/12 bg-white/10 px-3 py-1 text-xs font-semibold text-white/80">
                    {item.date}
                  </span>
                </div>

                <p class="mt-4 text-sm leading-relaxed text-white/75">{item.desc}</p>

                <div class="mt-4 flex flex-wrap gap-2">
                  {item.tags.map((tag) => (
                    <span class="rounded-full border border-white/12 bg-white/10 px-2.5 py-0.5 text-[11px] font-semibold text-white/80">
                      {tag}
                    </span>
                  ))}
                </div>
              </article>
            ))
          }
        </div>
      </div>
    </section>
```

---

### Task 5: Verify And Commit Implementation

**Files:**
- Review all modified files.

- [ ] **Step 1: Run production build**

Run: `npm run build`

Expected: Build completes successfully and writes output to `dist/`.

- [ ] **Step 2: Inspect git diff**

Run: `git diff`

Expected: Diff only includes the intended portfolio requirement changes.

- [ ] **Step 3: Commit implementation**

Run:

```bash
git add src/components/Welcome.astro src/components/Header.astro src/components/Footer.astro src/layouts/Layout.astro docs/superpowers/plans/2026-05-15-portfolio-requirements.md
git commit -m "Complete portfolio assignment requirements"
```

Expected: Commit succeeds.

- [ ] **Step 4: Push to remote**

Run: `git push`

Expected: The current branch is pushed to the configured remote.

---

## Self-Review

- Spec coverage: build fix, navigation, project filters, education/certificates, link fixes, accessibility states, verification, commit, and push are covered.
- Placeholder scan: no placeholder tasks remain.
- Type consistency: filter values use lowercase dash-separated strings across metadata, data attributes, and script.
