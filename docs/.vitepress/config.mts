import { defineConfig } from 'vitepress'

export default defineConfig({
    title: "PHP2JS",
    description: "Developing Laravel monoliths has never been easier and more efficient! 💻✨",
    lang: 'en-US',
    lastUpdated: true,
    base: '/PHP2JS',
    themeConfig: {
        footer: {
            message: 'Released under the MIT License.',
            copyright: 'Copyright © 2021-2023 Raul Mauricio Uñate'
        },
        editLink: {
            pattern: 'https://github.com/rmunate/PHP2JS/tree/main/docs/:path'
        },
        logo: '/img/php2js.png',
        nav: [
            {
                text: 'Docs ^4.4',
                link: '/',
            }
        ],
        sidebar: [
            {
                text: 'Getting Started',
                collapsed: false,
                items: [
                    {text: 'Introduction', link: '/home'},
                    {text: 'Installation', link: '/getting-started/installation'},
                    {text: 'Versions', link: '/getting-started/versions'},
                    {text: 'Release Notes', link: '/getting-started/changelog'},
                ]
            }, {
                text: 'Use In Controllers',
                collapsed: true,
                items: [
                    {text: 'View Return', link: '/controllers/view-return'},
                    {text: 'Share with JavaScript', link: '/controllers/share-with-js'},
                    {text: 'Share Specific Variables', link: '/controllers/share-specific-vars'},
                    {text: 'Assign a Custom Alias', link: '/controllers/assign-custom-alias'},
                ]
            }, {
                text: 'Use In JavaScript',
                collapsed: true,
                items: [
                    {text: 'Assign', link: '/javascript-methods/assign'},
                    {text: 'Destroy', link: '/javascript-methods/destroy'},
                    {text: 'Only', link: '/javascript-methods/only'},
                    {text: 'Except', link: '/javascript-methods/except'},
                    {text: 'Has', link: '/javascript-methods/has'},
                    {text: 'Get', link: '/javascript-methods/get'},
                    {text: 'Set', link: '/javascript-methods/set'},
                ]
            },{
                text: 'Contribute',
                collapsed: true,
                items: [
                    {text: 'Bug Report', link: '/contribute/report-bugs'},
                    {text: 'Contribution', link: '/contribute/contribution'}
                ]
            }
        ],
        socialLinks: [
            {icon: 'github', link: 'https://github.com/rmunate/PHP2JS'}
        ],
        search: {
            provider: 'local'
        }
    },
    head: [
        ['link', {
                rel: 'stylesheet',
                href: '/PHP2JS/css/style.css'
            }
        ],
        ['link', {
                rel: 'icon',
                href: '/PHP2JS/img/php2js.png',
                type: 'image/png'
            }
        ],
        ['meta', {
                property: 'og:image',
                content: '/PHP2JS/img/logo-github.png'
            }
        ],
        ['meta', {
                property: 'og:image:secure_url',
                content: '/PHP2JS/img/logo-github.png'
            }
        ],
        ['meta', {
                property: 'og:image:width',
                content: '600'
            }
        ],
        ['meta', {
                property: 'og:image:height',
                content: '400'
            }
        ],
        ['meta', {
                property: 'og:title',
                content: 'PHP2JS'
            }
        ],
        ['meta', {
                property: 'og:description',
                content: 'Developing Laravel monoliths has never been easier and more efficient! 💻✨'
            }
        ],
        ['meta', {
                property: 'og:url',
                content: 'https://rmunate.github.io/PHP2JS/'
            }
        ],
        ['meta', {
                property: 'og:type',
                content: 'website'
            }
        ]
    ],

})