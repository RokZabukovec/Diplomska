const isFile = (text) => /[^\\/]+\.[^\\/]+$/.test(text);
const isOperator = (text) => /^(\|{1,2})|(<{1,2})|(&{1,2})|(>{1,2})|{|\[|\]|\}/.test(text);
const isQuoted = (text) => /^(".+")|('.+')$/.test(text);

export let colorizeCommand = (command) => {
    const cursorNode = document.createElement("span");
    cursorNode.className = "stylized-commands";

    const originalTextContent = command.split(" ");

    originalTextContent.forEach((text, index) => {
        const textNode = document.createElement("span");
        textNode.textContent = `${text} `;

        // If first word or first after a pipe, highlight as command
        if (index === 0 || isOperator(originalTextContent[index - 1])) {
            textNode.className = "command";
            textNode.className = "text-stone-800";
        }

        if (text.startsWith("--") || text.startsWith("-")) {
            textNode.className = "flag";
            textNode.className = "text-blue-500";
        }

        if (isOperator(text)) {
            textNode.className = "operator";
            textNode.className = "text-orange-600";
        }

        if (isFile(text)) {
            textNode.className = "file";
            textNode.className = "text-green-500";
        }

        if (isQuoted(text)) {
            textNode.className = "quoted";
            textNode.className = "text-grey-500";
        }
        return cursorNode.appendChild(textNode);
    });
    return cursorNode.outerHTML;
};
