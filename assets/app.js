/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

const addInvoiceItemFormDeleteLink = (item) => {
    const removeFormButton = document.createElement('button');
    removeFormButton.innerText = 'Delete this item';
    removeFormButton.classList.add('btn-primary')
    removeFormButton.classList.add('btn')
    removeFormButton.classList.add('btn-sm')

    item.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        // remove the li for the tag form
        item.remove();
    });
};

const addFormToCollection = (e) => {
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

    collectionHolder.appendChild(item);

    collectionHolder.dataset.index++;

    addInvoiceItemFormDeleteLink(item);
};

document
    .querySelectorAll('.add-item')
    .forEach(btn => {
        btn.addEventListener("click", addFormToCollection)
    });

document
    .querySelectorAll('ul.invoice-lines li')
    .forEach((invoiceItem) => {
        addInvoiceItemFormDeleteLink(invoiceItem)
    })