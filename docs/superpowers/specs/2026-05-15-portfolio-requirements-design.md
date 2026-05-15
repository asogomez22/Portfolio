# Portfolio Requirements Design

## Goal

Update the portfolio so it satisfies the assignment requirements: personal data, skills, projects, project filtering, education/certificates, and accessibility for teachers reviewing it.

## Scope

- Keep the current Astro one-page portfolio structure.
- Add project filtering without introducing a framework-level rewrite.
- Add a clear education/certificates section.
- Fix broken or inconsistent links.
- Fix the production build issue caused by the unresolved `lenis` import.
- Improve basic accessibility and navigation consistency.
- Verify with `npm run build`.
- Commit and push the finished work to git.

## Content Changes

- Personal information remains in the hero, about, CV, contact, GitHub, and LinkedIn areas.
- Skills remain in the existing knowledge/skills section using the logo carousel.
- Projects remain in the current projects section, but each project gets filter categories.
- Education/certificates will be added as a dedicated section between projects/experience and skills.

## Project Filters

Filters will be implemented with lightweight client-side JavaScript in `Welcome.astro`.

Filter buttons:

- Todos
- Full Stack
- Frontend
- Backend
- Laravel
- React
- Symfony
- Tailwind

Each project card will expose its categories through a data attribute. Clicking a filter updates the visible cards, the active button state, and a small result count/message if useful.

## Accessibility And Navigation

- Add a real `id="top"` target for links that already point to `#top`.
- Add the education/certificates section to header and footer navigation.
- Keep existing form labels and focus rings.
- Improve project image alt text where appropriate.
- Use accessible button state for filters with `aria-pressed`.
- Preserve responsive behavior on desktop and mobile.

## Build Fix

The current build fails because `lenis` is listed in `package-lock.json` but the package is not present in `node_modules`. The fix will avoid relying on a package that may not be installed at build time. The simplest approach is to remove the `Lenis` import and smooth-scroll script from `Layout.astro`, since native anchor navigation and scrolling are sufficient for the assignment.

## Link Fixes

- Fix the malformed `hhttps://` URL for Aurea.
- Correct project URLs that appear swapped between Portfolio and Appetite For Posts.
- Ensure footer/internal links point to valid section IDs.

## Verification

- Run `npm run build` and confirm it succeeds.
- Review the changed files with `git diff`.
- Commit changes with a concise message.
- Push to the configured remote branch.
