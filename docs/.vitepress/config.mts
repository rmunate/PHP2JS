import {defineConfig} from 'vitepress'

// https://vitepress.dev/reference/site-config
export default defineConfig({
    title: "PHP2JS",
    description: "Share PHP-defined variables directly with the JavaScript files you want to use in your system.",
    lang: 'en-US',
    lastUpdated: true,
    base: '/PHP2JS',
    themeConfig: {
        logo: './../public/php2js.png',
        nav: [
            {text: 'v3.8.13 (2023/10/06)', link: '/'},
        ],
        sidebar: [
            {
                text: 'Getting Started',
                collapsed: false,
                items: [
                    {text: 'Introduction', link: '/'},
                    {text: 'Installation', link: '/getting-started/installation'},
                    {text: 'Versions', link: '/getting-started/versions'},
                ]
            }, {
                text: 'Controllers',
                collapsed: true,
                items: [
                    {text: 'View Return', link: '/controllers/view-return'},
                    {text: 'Share with JavaScript', link: '/controllers/share-with-js'},
                    {text: 'Assign a Custom Alias', link: '/controllers/assign-custom-alias'},
                    {text: 'Share Specific Variables', link: '/controllers/share-specific-vars'},
                    {text: 'Prebuilt Blocks', link: '/controllers/prebuild-blocks'},
                ]
            }, {
                text: 'Blade Directives',
                collapsed: true,
                items: [
                    {text: 'Everything', link: '/blade-directives/everything'},
                    {text: 'Specific Variables', link: '/blade-directives/specific-variables'}
                ]
            }, {
                text: 'Blade Blocks',
                collapsed: true,
                items: [
                    {text: 'Agent Data', link: '/blade-blocks/agent-data'},
                    {text: 'URL Data', link: '/blade-blocks/url-data'},
                    {text: 'CSRF Token', link: '/blade-blocks/csrf-token'},
                    {text: 'Laravel Data', link: '/blade-blocks/laravel-data'},
                    {text: 'PHP Data', link: '/blade-blocks/php-data'},
                    {text: 'User in Session', link: '/blade-blocks/user-in-session'},
                ]
            }, {
                text: 'JavaScript Methods',
                collapsed: true,
                items: [
                    {text: 'Clear', link: '/javascript-methods/clear'},
                    {text: 'Assign', link: '/javascript-methods/assign'},
                    {text: 'Only', link: '/javascript-methods/only'},
                    {text: 'Except', link: '/javascript-methods/except'},
                    {text: 'Check', link: '/javascript-methods/check'},
                    {text: 'Get', link: '/javascript-methods/get'},
                    {text: 'Set', link: '/javascript-methods/set'},
                ]
            }, {
                text: 'Contribute',
                collapsed: true,
                items: [
                    {text: 'Bug Report', link: 'contribute/report-bugs'},
                    {text: 'Contribution', link: 'contribute/contribution'}
                ]
            }
        ],

        socialLinks: [
            {icon: 'github', link: 'https://github.com/rmunate/SpellNumber'}
        ],
        search: {
            provider: 'local'
        }
    },
    head: [
        ['link', {
                rel: 'icon',
                href: '/PHP2JS/php2js.png',
                type: 'image/png'
            }
        ],
        ['meta', {
                property: 'og:image',
                content: '/SpellNumber/logo-github.png' 
            }
        ],
        ['meta', {
                property: 'og:image:secure_url',
                content: '/SpellNumber/logo-github.png'
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
                content: 'SpellNumber'
            }
        ],
        ['meta', {
                property: 'og:description',
                content: 'Easily convert numbers to words in Laravel Framework.'
            }
        ],
        ['meta', {
                property: 'og:url',
                content: 'https://rmunate.github.io/SpellNumber/'
            }
        ],
        ['meta', {
                property: 'og:type',
                content: 'website'
            }
        ],
    ],
})
