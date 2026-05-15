# Certificates Update Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Replace the current education items with the four OpenWebinars certificates requested by the user.

**Architecture:** Keep the existing `Formación y certificados` section and card layout in `src/components/Welcome.astro`. Only update the data shape and card rendering needed to show certificate links.

**Tech Stack:** Astro 5, Tailwind CSS utility classes, static links.

---

## File Structure

- Modify `src/components/Welcome.astro`: replace `educationItems` contents with certificate items and update the card body to link to certificates.
- Verify with `npm run build`.
- Commit and push the change.

---

### Task 1: Replace Education Items With Certificates

**Files:**
- Modify: `src/components/Welcome.astro`

- [ ] **Step 1: Replace the data array**

Replace the existing `educationItems` array with:

```js
const educationItems = [
  {
    title: "Aprende a programar en Python",
    place: "OpenWebinars",
    desc: "Certificado de fundamentos de programación con Python.",
    href: "https://openwebinars.net/certificacion/KY0ZHa8u?type=png",
    tags: ["Python", "Programación", "Fundamentos"],
  },
  {
    title: "Python desde 0",
    place: "OpenWebinars",
    desc: "Certificado de aprendizaje inicial de Python desde cero.",
    href: "https://openwebinars.net/certificacion/odVkYG2x?type=png",
    tags: ["Python", "Desde cero"],
  },
  {
    title: "Hacking Web",
    place: "OpenWebinars",
    desc: "Certificado orientado a seguridad y hacking web.",
    href: "https://openwebinars.net/cert/Lfyz",
    tags: ["Seguridad", "Web", "Hacking"],
  },
  {
    title: "PHP Fundamentos",
    place: "OpenWebinars",
    desc: "Certificado de fundamentos de PHP.",
    href: "https://openwebinars.net/certificacion/GwNM5oDv?type=png",
    tags: ["PHP", "Backend", "Fundamentos"],
  },
];
```

- [ ] **Step 2: Update the card date badge to a certificate link**

Replace the span that currently renders `{item.date}` with:

```astro
                  <a
                    href={item.href}
                    target="_blank"
                    rel="noopener noreferrer"
                    class="w-fit rounded-full border border-white/12 bg-white/10 px-3 py-1 text-xs font-semibold text-white/80 transition hover:bg-white/15 hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/45"
                  >
                    Ver certificado
                  </a>
```

- [ ] **Step 3: Verify production build**

Run: `npm run build`

Expected: Build completes successfully.

- [ ] **Step 4: Commit and push**

Run:

```bash
git add src/components/Welcome.astro docs/superpowers/plans/2026-05-15-certificates-update.md
git commit -m "Update portfolio certificates"
git push
```

Expected: Commit is pushed to `origin/main`.

---

## Self-Review

- Spec coverage: removes DAW and company stay by replacing the full data array, adds all four requested certificates, keeps the existing section layout, verifies build, commits, and pushes.
- Placeholder scan: no placeholders remain.
- Type consistency: each item has `title`, `place`, `desc`, `href`, and `tags`; rendering uses only these fields.
