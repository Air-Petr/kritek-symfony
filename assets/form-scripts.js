document
    .querySelectorAll('.add-line')
    .forEach(btn => {
        btn.addEventListener("click", addInvoiceLineForm)
    });

function addInvoiceLineDeleteLink(item) {
    const removeFormButton = document.createElement('button');
    removeFormButton.innerText = 'Delete this line';
    removeFormButton.classList.add('btn-primary', 'btn', 'btn-sm');

    item.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        item.remove();
    });
}

function addInvoiceLineForm(e) {
    const collectionHolder = document.querySelector('#invoice_invoice_lines');
    const item = document.createElement('div');

    item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
            /__name__label__/g,
            'Item' + (parseInt(collectionHolder.dataset.index) + 1)
        )
        .replace(
            /__name__/g,
            collectionHolder.dataset.index
        );

    item.classList.add('invoice-line');

    collectionHolder.appendChild(item);
    collectionHolder.dataset.index++;

    addInvoiceLineDeleteLink(item);
}