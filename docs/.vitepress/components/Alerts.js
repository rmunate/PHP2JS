export const Alerts = {

    /* Alerta Warning */
    warning: (options = {}) => {

        let title = '', image = '', body = '', link = '';

        if (options.hasOwnProperty('title')) {
            title = `
            <p class="custom-block-title" style="color: #ff6347; font-size: 11px; font-weight: bold; margin-bottom: 10px; line-height: 1.3">
                ${options.title}
            </p>
            `;
        }

        if (options.hasOwnProperty('image')) {
            image = `
            <div style="display: flex; justify-content: center; margin-top: 5px; margin-bottom: 5px">
                <div>
                    <img src="${options.image}" style="border-radius: 50%; max-height: 140px;" />
                </div>
            </div>
            `;
        }

        if (options.hasOwnProperty('body')) {
            options.body.forEach(element => {
                body += `
                <p style="font-size: 13px; line-height: 1.4; margin-bottom: 10px;">
                    ${element}
                </p>`;
            });
        }

        if (options.hasOwnProperty('link')) {
            link = `<a style="font-size: 12px; text-decoration: none; color: #ff6347;" href="${options.link.href}">${options.link.text}</a>`;
        }

        return `
        <div style="margin-top: 20px; margin-left: 10px; margin-right: 10px">
            <div class="warning custom-block" style="margin-top: 20px; text-align: center; border: 2px solid #ff6347; border-radius: 8px; padding: 2px;">
                <div class="custom-block">
                    ${title}
                    ${image}
                    ${body}
                    ${link}
                </div>
            </div>
        </div>
        `;
    },

    /* Alert Success */
    success: (options = {}) => {

        let title = '', image = '', body = '', link = '';

        if (options.hasOwnProperty('title')) {
            title = `
            <p class="custom-block-title" style="color: #28a745; font-size: 11px; font-weight: bold; margin-bottom: 10px; line-height: 1.3">
                ${options.title}
            </p>
            `;
        }

        if (options.hasOwnProperty('image')) {
            image = `
            <div style="display: flex; justify-content: center; margin-top: 5px; margin-bottom: 5px">
                <div>
                    <img src="${options.image}" style="border-radius: 50%; max-height: 140px;" />
                </div>
            </div>
            `;
        }

        if (options.hasOwnProperty('body')) {
            options.body.forEach(element => {
                body += `
                <p style="font-size: 13px; line-height: 1.4; margin-bottom: 10px;">
                    ${element}
                </p>`;
            });
        }

        if (options.hasOwnProperty('link')) {
            link = `<a style="font-size: 12px; text-decoration: none; color: #ff6347;" href="${options.link.href}">${options.link.text}</a>`;
        }

        return `
        <div style="margin-top: 20px; margin-left: 10px; margin-right: 10px">
            <div class="success custom-block" style="text-align: center; border: 2px solid #28a745; border-radius: 8px; padding: 15px;">
                <div class="custom-block">
                    ${title}
                    ${image}
                    ${body}
                    ${link}
                </div>
            </div>
        </div>
        `;
    },
};
