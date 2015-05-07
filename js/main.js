(function () {
    'use strict';

    let makes;
    let models;

    const getModels = () => {
        getJSON('models.php').then((data) => {
            models = data;

            console.log(models);

            let makeList = byId('makes');
            let modelList = byId('models');
            let carList = byId('cars');

            makes = models.reduce((memo, model) => {
                if (!memo[model.make]) {
                    memo[model.make] = 1;
                } else {
                    memo[model.make]++;
                }
                return memo;
            }, {});

            let html = Object.keys(makes).map(make => `<a href="#" class="list-group-item" data-make="${make}">
                                                            <span class="badge">${makes[make]}</span>
                                                        ${make}</a>`);

            makeList.insertAdjacentHTML('beforeend', html.join(''));

            makeList.addEventListener('click', (e) => {
                let nodeName = e.target.nodeName.toUpperCase();
                let make;

                if (nodeName === 'SPAN') {
                    make = e.target.parentNode.dataset.make;
                } else {
                    make = e.target.dataset.make;
                }

                let currentSet = models.filter(model => model.make === make);
                let items = currentSet.map(model => `<a href="#" class="list-group-item">${model.model}</a>`);

                while (modelList.lastChild) { modelList.removeChild(modelList.lastChild); }
                modelList.insertAdjacentHTML('beforeend', items.join(''));

                e.preventDefault();
            });

            console.log(makes);
        }).catch((err) => {
            console.log(err);
        });
    };

    const getJSON = (endpoint) => {
        return new Promise((resolve, reject) => {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', encodeURI(endpoint));
            xhr.onload = () => {
                if (xhr.status === 200) {
                    resolve(JSON.parse(xhr.responseText));
                } else {
                    reject('something blew up ' + xhr.status);
                }
            };
            xhr.send(null);
        });

    };


    getModels();
})();