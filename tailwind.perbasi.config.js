// Tailwind untuk tema frontend "perbasi".
// Build: npm run build:perbasi  ->  public/themes/perbasi/css/app.css (di-commit, server tidak perlu Node)
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/themes/perbasi/**/*.blade.php',
    ],
    darkMode: "class",
    theme: {
        extend: {
            "colors": {
                "off-white": "#F8F9FA",
                "primary": "#87021e",
                "crimson-red": "#A92333",
                "on-primary": "#ffffff",
                "tertiary-fixed-dim": "#e9c349",
                "amber-gold": "#D4AF37",
                "primary-fixed-dim": "#ffb3b3",
                "tertiary-container": "#cba72f",
                "charcoal": "#1A1D20",
                "surface-container-high": "#e7e8e9",
                "inverse-primary": "#ffb3b3",
                "surface-container-lowest": "#ffffff",
                "surface-container": "#edeeef",
                "on-tertiary-fixed-variant": "#574500",
                "on-primary-fixed": "#400009",
                "surface-variant": "#e1e3e4",
                "secondary-fixed-dim": "#c5c6ca",
                "primary-container": "#a92333",
                "on-secondary-fixed": "#191c1f",
                "secondary-fixed": "#e1e2e6",
                "on-surface": "#191c1d",
                "inverse-surface": "#2e3132",
                "surface-tint": "#b12938",
                "surface": "#f8f9fa",
                "primary-fixed": "#ffdad9",
                "outline-variant": "#e0bfbe",
                "on-secondary-container": "#606366",
                "on-surface-variant": "#594140",
                "error": "#ba1a1a",
                "inverse-on-surface": "#f0f1f2",
                "tertiary-fixed": "#ffe088",
                "surface-container-highest": "#e1e3e4",
                "on-error-container": "#93000a",
                "on-primary-container": "#ffc0bf",
                "on-primary-fixed-variant": "#8f0c23",
                "error-container": "#ffdad6",
                "on-background": "#191c1d",
                "surface-bright": "#f8f9fa",
                "surface-container-low": "#f3f4f5",
                "on-error": "#ffffff",
                "on-tertiary-container": "#4e3d00",
                "surface-dim": "#d9dadb",
                "background": "#f8f9fa",
                "tertiary": "#735c00",
                "on-tertiary": "#ffffff",
                "on-secondary": "#ffffff",
                "secondary-container": "#dee0e4",
                "secondary": "#5c5f62",
                "on-tertiary-fixed": "#241a00",
                "outline": "#8d7070",
                "on-secondary-fixed-variant": "#44474a"
            },
            "borderRadius": {
                "DEFAULT": "0.125rem",
                "lg": "0.25rem",
                "xl": "0.5rem",
                "full": "0.75rem"
            },
            "spacing": {
                "stack-lg": "32px",
                "margin-mobile": "20px",
                "stack-md": "16px",
                "stack-sm": "8px",
                "container-max": "1280px",
                "section-padding": "80px",
                "section-padding-mobile": "40px",
                "margin-desktop": "64px",
                "gutter": "24px"
            },
            "fontFamily": {
                "label-bold": ["Inter"],
                "headline-xl-mobile": ["Oswald"],
                "headline-md": ["Oswald"],
                "headline-lg": ["Oswald"],
                "body-md": ["Inter"],
                "body-lg": ["Inter"],
                "stats-display": ["Oswald"],
                "headline-xl": ["Oswald"]
            },
            "fontSize": {
                "label-bold": ["14px", {
                    "lineHeight": "20px",
                    "letterSpacing": "0.05em",
                    "fontWeight": "700"
                }],
                "headline-xl-mobile": ["32px", {
                    "lineHeight": "40px",
                    "letterSpacing": "-0.01em",
                    "fontWeight": "700"
                }],
                "headline-md": ["32px", {
                    "lineHeight": "40px",
                    "fontWeight": "600"
                }],
                "headline-lg": ["48px", {
                    "lineHeight": "56px",
                    "letterSpacing": "0em",
                    "fontWeight": "600"
                }],
                "body-sm": ["12px", {
                    "lineHeight": "20px",
                    "fontWeight": "400"
                }],
                "body-md": ["16px", {
                    "lineHeight": "24px",
                    "fontWeight": "400"
                }],
                "body-lg": ["18px", {
                    "lineHeight": "28px",
                    "fontWeight": "400"
                }],
                "stats-display": ["24px", {
                    "lineHeight": "32px",
                    "fontWeight": "700"
                }],
                "headline-xl": ["64px", {
                    "lineHeight": "72px",
                    "letterSpacing": "-0.02em",
                    "fontWeight": "700"
                }]
            }
        },
    },
    plugins: [forms],
};
