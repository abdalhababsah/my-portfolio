// import { Grid } from "gridjs/dist/gridjs.umd.js";
// import gridjs from 'gridjs/dist/gridjs.umd.js'
// import 'gridjs/dist/gridjs.umd.js'

// class GridDatatable {

//     init() {
//          this.GridjsTableInit();
//     }

//     GridjsTableInit() {

//          // Basic Table
//          if (document.getElementById("table-gridjs"))
//               new Grid({
//                    columns: [{
//                         name: 'ID',
//                         formatter: (function (cell) {
//                              return gridjs.html('<span class="fw-semibold">' + cell + '</span>');
//                         })
//                    },
//                         "Name",
//                    {
//                         name: 'Email',
//                         formatter: (function (cell) {
//                              return gridjs.html('<a href="">' + cell + '</a>');
//                         })
//                    },
//                         "Position", "Company", "Country",
//                    {
//                         name: 'Actions',
//                         width: '120px',
//                         formatter: (function (cell) {
//                              return gridjs.html("<a href='#' class='text-reset text-decoration-underline'>" + "Details" + "</a>");
//                         })
//                    },
//                    ],
//                    pagination: {
//                         limit: 5
//                    },
//                    sort: true,
//                    search: true,
//                    data: [
//                         ["11", "Alice", "alice@example.com", "Software Engineer", "ABC Company", "United States"],
//                         ["12", "Bob", "bob@example.com", "Product Manager", "XYZ Inc", "Canada"],
//                         ["13", "Charlie", "charlie@example.com", "Data Analyst", "123 Corp", "Australia"],
//                         ["14", "David", "david@example.com", "UI/UX Designer", "456 Ltd", "United Kingdom"],
//                         ["15", "Eve", "eve@example.com", "Marketing Specialist", "789 Enterprises", "France"],
//                         ["16", "Frank", "frank@example.com", "HR Manager", "ABC Company", "Germany"],
//                         ["17", "Grace", "grace@example.com", "Financial Analyst", "XYZ Inc", "Japan"],
//                         ["18", "Hannah", "hannah@example.com", "Sales Representative", "123 Corp", "Brazil"],
//                         ["19", "Ian", "ian@example.com", "Software Developer", "456 Ltd", "India"],
//                         ["20", "Jane", "jane@example.com", "Operations Manager", "789 Enterprises", "China"]
//                    ]
//               }).render(document.getElementById("table-gridjs"));



//          // pagination Table
//          if (document.getElementById("table-pagination"))
//               new Grid({
//                    columns: [{
//                         name: 'ID',
//                         width: '120px',
//                         formatter: (function (cell) {
//                              return gridjs.html('<a href="" class="fw-medium">' + cell + '</a>');
//                         })
//                    }, "Name", "Date", "Total",
//                    {
//                         name: 'Actions',
//                         width: '100px',
//                         formatter: (function (cell) {
//                              return gridjs.html("<button type='button' class='btn btn-sm btn-light'>" +
//                                   "Details" +
//                                   "</button>");
//                         })
//                    },
//                    ],
//                    pagination: {
//                         limit: 5
//                    },

//                    data: [
//                         ["#RB2320", "Alice", "07 Oct, 2024", "$24.05"],
//                         ["#RB8652", "Bob", "07 Oct, 2024", "$26.15"],
//                         ["#RB8520", "Charlie", "06 Oct, 2024", "$21.25"],
//                         ["#RB9512", "David", "05 Oct, 2024", "$25.03"],
//                         ["#RB7532", "Eve", "05 Oct, 2024", "$22.61"],
//                         ["#RB9632", "Frank", "04 Oct, 2024", "$24.05"],
//                         ["#RB7456", "Grace", "04 Oct, 2024", "$26.15"],
//                         ["#RB3002", "Hannah", "04 Oct, 2024", "$21.25"],
//                         ["#RB9857", "Ian", "03 Oct, 2024", "$22.61"],
//                         ["#RB2589", "Jane", "03 Oct, 2024", "$25.03"],
//                    ]
//               }).render(document.getElementById("table-pagination"));

//          // search Table
//          if (document.getElementById("table-search"))
//               new Grid({
//                    columns: ["Name", "Email", "Position", "Company", "Country"],
//                    pagination: {
//                         limit: 5
//                    },
//                    search: true,
//                    data: [
//                         ["Alice", "alice@example.com", "Software Engineer", "ABC Company", "United States"],
//                         ["Bob", "bob@example.com", "Product Manager", "XYZ Inc", "Canada"],
//                         ["Charlie", "charlie@example.com", "Data Analyst", "123 Corp", "Australia"],
//                         ["David", "david@example.com", "UI/UX Designer", "456 Ltd", "United Kingdom"],
//                         ["Eve", "eve@example.com", "Marketing Specialist", "789 Enterprises", "France"],
//                         ["Frank", "frank@example.com", "HR Manager", "ABC Company", "Germany"],
//                         ["Grace", "grace@example.com", "Financial Analyst", "XYZ Inc", "Japan"],
//                         ["Hannah", "hannah@example.com", "Sales Representative", "123 Corp", "Brazil"],
//                         ["Ian", "ian@example.com", "Software Developer", "456 Ltd", "India"],
//                         ["Jane", "jane@example.com", "Operations Manager", "789 Enterprises", "China"]
//                    ]
//               }).render(document.getElementById("table-search"));

//          // Sorting Table
//          if (document.getElementById("table-sorting"))
//               new Grid({
//                    columns: ["Name", "Email", "Position", "Company", "Country"],
//                    pagination: {
//                         limit: 5
//                    },
//                    sort: true,
//                    data: [
//                         ["Alice", "alice@example.com", "Software Engineer", "ABC Company", "United States"],
//                         ["Bob", "bob@example.com", "Product Manager", "XYZ Inc", "Canada"],
//                         ["Charlie", "charlie@example.com", "Data Analyst", "123 Corp", "Australia"],
//                         ["David", "david@example.com", "UI/UX Designer", "456 Ltd", "United Kingdom"],
//                         ["Eve", "eve@example.com", "Marketing Specialist", "789 Enterprises", "France"],
//                         ["Frank", "frank@example.com", "HR Manager", "ABC Company", "Germany"],
//                         ["Grace", "grace@example.com", "Financial Analyst", "XYZ Inc", "Japan"],
//                         ["Hannah", "hannah@example.com", "Sales Representative", "123 Corp", "Brazil"],
//                         ["Ian", "ian@example.com", "Software Developer", "456 Ltd", "India"],
//                         ["Jane", "jane@example.com", "Operations Manager", "789 Enterprises", "China"]
//                    ]
//               }).render(document.getElementById("table-sorting"));


//          // Loading State Table
//          if (document.getElementById("table-loading-state"))
//               new Grid({
//                    columns: ["Name", "Email", "Position", "Company", "Country"],
//                    pagination: {
//                         limit: 5
//                    },
//                    sort: true,
//                    data: function () {
//                         return new Promise(function (resolve) {
//                              setTimeout(function () {
//                                   resolve([
//                                        ["Alice", "alice@example.com", "Software Engineer", "ABC Company", "United States"],
//                                        ["Bob", "bob@example.com", "Product Manager", "XYZ Inc", "Canada"],
//                                        ["Charlie", "charlie@example.com", "Data Analyst", "123 Corp", "Australia"],
//                                        ["David", "david@example.com", "UI/UX Designer", "456 Ltd", "United Kingdom"],
//                                        ["Eve", "eve@example.com", "Marketing Specialist", "789 Enterprises", "France"],
//                                        ["Frank", "frank@example.com", "HR Manager", "ABC Company", "Germany"],
//                                        ["Grace", "grace@example.com", "Financial Analyst", "XYZ Inc", "Japan"],
//                                        ["Hannah", "hannah@example.com", "Sales Representative", "123 Corp", "Brazil"],
//                                        ["Ian", "ian@example.com", "Software Developer", "456 Ltd", "India"],
//                                        ["Jane", "jane@example.com", "Operations Manager", "789 Enterprises", "China"]
//                                   ])
//                              }, 2000);
//                         });
//                    }
//               }).render(document.getElementById("table-loading-state"));


//          // Fixed Header
//          if (document.getElementById("table-fixed-header"))
//               new Grid({
//                    columns: ["Name", "Email", "Position", "Company", "Country"],
//                    sort: true,
//                    pagination: true,
//                    fixedHeader: true,
//                    height: '400px',
//                    data: [
//                         ["Alice", "alice@example.com", "Software Engineer", "ABC Company", "United States"],
//                         ["Bob", "bob@example.com", "Product Manager", "XYZ Inc", "Canada"],
//                         ["Charlie", "charlie@example.com", "Data Analyst", "123 Corp", "Australia"],
//                         ["David", "david@example.com", "UI/UX Designer", "456 Ltd", "United Kingdom"],
//                         ["Eve", "eve@example.com", "Marketing Specialist", "789 Enterprises", "France"],
//                         ["Frank", "frank@example.com", "HR Manager", "ABC Company", "Germany"],
//                         ["Grace", "grace@example.com", "Financial Analyst", "XYZ Inc", "Japan"],
//                         ["Hannah", "hannah@example.com", "Sales Representative", "123 Corp", "Brazil"],
//                         ["Ian", "ian@example.com", "Software Developer", "456 Ltd", "India"],
//                         ["Jane", "jane@example.com", "Operations Manager", "789 Enterprises", "China"]
//                    ]
//               }).render(document.getElementById("table-fixed-header"));


//          // Hidden Columns
//          if (document.getElementById("table-hidden-column"))
//               new Grid({
//                    columns: ["Name", "Email", "Position", "Company",
//                         {
//                              name: 'Country',
//                              hidden: true
//                         },
//                    ],
//                    pagination: {
//                         limit: 5
//                    },
//                    sort: true,
//                    data: [
//                         ["Alice", "alice@example.com", "Software Engineer", "ABC Company", "United States"],
//                         ["Bob", "bob@example.com", "Product Manager", "XYZ Inc", "Canada"],
//                         ["Charlie", "charlie@example.com", "Data Analyst", "123 Corp", "Australia"],
//                         ["David", "david@example.com", "UI/UX Designer", "456 Ltd", "United Kingdom"],
//                         ["Eve", "eve@example.com", "Marketing Specialist", "789 Enterprises", "France"],
//                         ["Frank", "frank@example.com", "HR Manager", "ABC Company", "Germany"],
//                         ["Grace", "grace@example.com", "Financial Analyst", "XYZ Inc", "Japan"],
//                         ["Hannah", "hannah@example.com", "Sales Representative", "123 Corp", "Brazil"],
//                         ["Ian", "ian@example.com", "Software Developer", "456 Ltd", "India"],
//                         ["Jane", "jane@example.com", "Operations Manager", "789 Enterprises", "China"]
//                    ]
//               }).render(document.getElementById("table-hidden-column"));


//     }

// }

// document.addEventListener('DOMContentLoaded', function (e) {
//     new GridDatatable().init();
// });
// ====================================== my code ======================================



import { Grid, html } from "gridjs";
import 'gridjs/dist/gridjs.umd.js'
class GridDatatable {
    /**
     * Render a search table into a specific DOM element
     * @param {string} elementId - The ID of the element to render the table into
     * @param {Array<string>} columns - The column names
     * @param {Array<Array>} data - The row data
     */
    renderSearchTable(elementId, columns, data) {
        const container = document.getElementById(elementId);

        if (!container) {
            console.warn(`Element with id "${elementId}" not found.`);
            return;
        }

        new Grid({
            columns,
            pagination: {
                limit: 5
            },
            search: true,
            data
        }).render(container);
    }
}

// // 🔁 Initialize multiple tables (reusable)
// document.addEventListener('DOMContentLoaded', function () {
//     const table = new GridDatatable();

//     // Example 1: for table-projects
//     table.renderSearchTable("table-projects",
//         ["Name", "Email", "Position", "Company", "Country"],
//         [
//             ["Alice", "alice@example.com", "Software Engineer", "ABC Company", "United States"],
//             // ["Bob", "bob@example.com", "Product Manager", "XYZ Inc", "Canada"],
//             ["Charlie", "charlie@example.com", "Data Analyst", "123 Corp", "Australia"],
//             ["David", "david@example.com", "UI/UX Designer", "456 Ltd", "United Kingdom"],
//             ["Eve", "eve@example.com", "Marketing Specialist", "789 Enterprises", "France"],
//             ["Frank", "frank@example.com", "HR Manager", "ABC Company", "Germany"],
//             ["Grace", "grace@example.com", "Financial Analyst", "XYZ Inc", "Japan"],
//             ["Hannah", "hannah@example.com", "Sales Representative", "123 Corp", "Brazil"],
//             ["Ian", "ian@example.com", "Software Developer", "456 Ltd", "India"],
//             ["Jane", "jane@example.com", "Operations Manager", "789 Enterprises", "China"]
//         ]
//     );

//     // Example 2: for table-blogs (you can add as many as you want)
//     table.renderSearchTable("table-blogs",
//         ["Title", "Author", "Date", "Status"],
//         [
//             ["Getting Started with Grid.js", "Hamza", "2024-04-20", "Published"],
//             ["Advanced Laravel Tips", "Ahmad", "2024-04-18", "Draft"],
//             ["Vue vs React", "Nour", "2024-04-15", "Published"],
//             ["Security Best Practices", "Ali", "2024-04-10", "Archived"]
//         ]
//     );
// });

function renderGrid(elementId, columns, data, routes = {}) {
    const el = document.getElementById(elementId);

    if (!el) {
        console.warn(`Element with ID "${elementId}" not found.`);
        return;
    }

    const extendedColumns = [
        ...columns,
        {
            name: "Actions",
            width: "160px",
            formatter: (cell, row) => {
                const id = row.cells[0].data;
                // console.log('route', routes);
                const editUrl = routes.edit?.replace(':id', id) ?? '#';
                const deleteUrl = routes.delete?.replace(':id', id) ?? '#';
                // console.log('deleteUrl', editUrl);
                return html(`
                    <a href="${editUrl}" class="btn btn-sm btn-outline-secondary" style="margin-right: 5px; margin-bottom:8px;">Edit</a>
                    <form method="POST" action="${deleteUrl}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this project?')">
                        <input type="hidden" name="_token" value="${window.csrfToken}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                `);

            }
        }
    ];

    new Grid({
        columns: extendedColumns,
        pagination: { limit: 10 },
        search: true,
        data: data
    }).render(el);
}

document.addEventListener('DOMContentLoaded', () => {
    if (window.gridConfigs && Array.isArray(window.gridConfigs)) {
        window.gridConfigs.forEach(config => {
            renderGrid(config.elementId, config.columns, config.data, config.routes); // ✅ pass routes
        });
    }

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-edit')) {
            const id = e.target.dataset.id;
            alert(`Edit clicked for ID: ${id}`);
        }

        if (e.target.classList.contains('btn-delete')) {
            const id = e.target.dataset.id;
            if (confirm(`Delete project with ID ${id}?`)) {
                alert(`Deleted ID: ${id}`);
            }
        }
    });
});


