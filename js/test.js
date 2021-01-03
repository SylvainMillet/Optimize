$(document).ready(function() {  

var hotElement = document.querySelector('#testtableau');
  var hotElementContainer = hotElement.parentNode;
  var hotSettings = {
    data: [],
    columns: [
        {
            data: 'id',
            type: 'numeric',
            width: 40
        },
        {
            data: 'currencyCode',
            type: 'text'
        },
        {
            data: 'currency',
            type: 'text'
        },
        {
            data: 'level',
            type: 'numeric',
            format: '0.0000'
        },
        {
            data: 'units',
            type: 'text'
        },
        {
            data: 'asOf',
            type: 'date',
            dateFormat: 'MM/DD/YYYY'
        },
        {
            data: 'onedChng',
            type: 'numeric',
            format: '0.00%'
        }
    ],
    stretchH: 'all',
    width: 806,
    autoWrapRow: true,
    height: 441,
    maxRows: 22,
    rowHeaders: true,
    colHeaders: [
        'ID',
        'Code',
        'Currency',
        'Level',
        'Units',
        'Date',
        'Change'
    ]
};

  var hot = new Handsontable(hotElement, hotSettings);
  
});