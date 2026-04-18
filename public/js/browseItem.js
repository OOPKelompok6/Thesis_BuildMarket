var itemJson;

function populateSearchForm(params) {

    if(params.name !== undefined) {
        document.getElementById("itemNameInput").value = params.name;
    }

    if(params.sellerName !== undefined) {
        document.getElementById("sellerNameInput").value = params.sellerName;
    }

    if(params.category !== undefined) {
        document.getElementById("categorySelect").value = params.category;
    }

    if(params.brand !== undefined) {
        document.getElementById("brandSelect").value = params.brand;
    }

    if(params.ordering !== undefined) {
        document.getElementById("orderingSelect").value = params.ordering;
    }
    
}

async function fetchItemData(url) {
  var defaultUrl = new URL(window.location.href);
  url ?? (url = `api/items${defaultUrl.search}`);
  url = new URL(url, window.location.origin);

  try {
    const response = await fetch(url.toString());
    
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    itemJson = await response.json();

    populateSearchForm(Object.fromEntries(new URLSearchParams(url.search)));

    var isPaginationExist = document.getElementById("paginationItem");
    if(isPaginationExist) {
        isPaginationExist.remove();
    }
    if(itemJson.links.length >= 4) {
        builtPagination(itemJson);
    }

    populateItemList(itemJson.data); 

  } catch (error) {
    console.error(error.message);
  }
}

function builtPagination(pageSpecs) {

    var curIndex = pageSpecs.links.findIndex(link => link.active);
    var startInd = (curIndex - 2) < 1 ? 1 : curIndex - 2; 
    var endInd = (curIndex + 2) >= pageSpecs.links.length - 1 ? pageSpecs.links.length - 2 : curIndex + 2;
    
    if(startInd == 1) {
        endInd = (startInd + 4 > pageSpecs.links.length - 2) ? 2 : startInd + 4;
    }

    if(endInd == pageSpecs.links.length - 2) {
        startInd = (endInd - 4 < 1) ? 1 : endInd - 4;
    }

    var container = document.createElement("nav");
    container.setAttribute("class", "d-flex mt-3 align-items-center justify-content-center");
    container.setAttribute("id", "paginationItem");

    var idPagination = document.createElement("ul");
    idPagination.setAttribute("class", "pagination pagination-sm");
    container.appendChild(idPagination);

    for(; startInd <= endInd; startInd++) {
        var itemList =  document.createElement("li");
        itemList.setAttribute("class", `page-item ${(pageSpecs.links[startInd].active) ? " active": ""}`);

        var actBtn = document.createElement("button");
        actBtn.setAttribute("class", "page-link");

        actBtn.addEventListener("click", (event) => {
            fetchItemData(`${pageSpecs.links[startInd].url}`);
        });

        actBtn.innerHTML = pageSpecs.links[startInd].page;
        itemList.appendChild(actBtn);

        idPagination.appendChild(itemList);
    }

    document.getElementById("itemFilterForm").appendChild(container);
}

function createCard(item) {
    var cardOuter = document.createElement("div");
    cardOuter.setAttribute("class", "d-flex flex-row rounded-3 overflow-hidden");
    cardOuter.setAttribute("style", "background-color: #1e1e1e; border: 1px solid #2e2e2e; max-width: 50%;");
    
    var imageContainer = document.createElement("div");
    imageContainer.setAttribute("class", "d-flex align-items-center justify-content-center");
    imageContainer.setAttribute("style", "width: 80px; min-height: 100px; background-color: #2a2a2a; flex-shrink: 0;");
    cardOuter.appendChild(imageContainer);

    var image = document.createElement("img");
    image.setAttribute("style", "width: 80px; object-fit: cover;");

    if(item.category.name == "Plumbing") {
        image.setAttribute("src", "images/cards/plumbing_thumbnail.png");
    }
    else if(item.category.name == "Flooring") {
        image.setAttribute("src", "images/cards/flooring_thumbnail.png");
    }
    else if(item.category.name == "Tools & Hardware") {
        image.setAttribute("src", "images/cards/tools_thumbnail.png");
    }
    else if(item.category.name == "Cement") {
        image.setAttribute("src", "images/cards/cement_thumbnail.png");
    }
    else {
        image.setAttribute("src", "images/cards/bathroom_thumbnail.png");
    }
    imageContainer.appendChild(image);

    var itemDescContainer = document.createElement("div");
    itemDescContainer.setAttribute("class", "d-flex flex-column p-2");
    cardOuter.appendChild(itemDescContainer);

    var descInfo = document.createElement("p");
    descInfo.setAttribute("class", "text-secondary mb-1");
    descInfo.setAttribute("style", "font-size: 0.72rem; line-height: 1.4;");
    descInfo.innerHTML = item.category.name ;

    var addBrand = document.createElement("span");
    addBrand.setAttribute("class", "ms-3");
    addBrand.innerHTML = item.brand.name ;
    descInfo.appendChild(addBrand);
    
    itemDescContainer.appendChild(descInfo);

    var title = document.createElement("p");
    title.setAttribute("class", "text-light fw-bold mb-1");
    title.setAttribute("style", "font-size: 0.8rem;");
    title.innerHTML = item.name;
    itemDescContainer.appendChild(title);

    var desc = document.createElement("p");
    desc.setAttribute("class", "text-secondary mb-1");
    desc.setAttribute("style", "font-size: 0.72rem; line-height: 1.4;");
    desc.innerHTML = item.description.slice(0, 80) + "...";
    itemDescContainer.appendChild(desc);

    var price = document.createElement("p");
    price.setAttribute("class", "text-light fw-bold mb-1");
    price.setAttribute("style", "font-size: 0.8rem;");

    const idrFormatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    });
    price.innerHTML = idrFormatter.format(item.price);
    itemDescContainer.appendChild(price);

    var viewItemTag = document.createElement("a");
    viewItemTag.setAttribute("class", "mt-auto");
    viewItemTag.setAttribute("href", `/products/${item.id}`);
    viewItemTag.setAttribute("style", "font-size: 0.75rem; color: #aaa; text-decoration: none;");
    viewItemTag.innerHTML = "View item \u203A";
    itemDescContainer.appendChild(viewItemTag);

    return cardOuter;
}

function populateItemList(data) {
    var itemContainer = document.getElementById("itemPlace");
    itemContainer.innerHTML = "";
    var ind = 0; var rowNum = Math.ceil(data.length / 2);

    if(data.length != 0) {
        for(var i = 0; i < rowNum; i++) {
            var row = document.createElement("div");
            row.setAttribute("class", "w-100 d-flex flex-row mb-4 gap-5");

            for(var j = 0; j < 2; j++) {
                
                if(ind == data.length) {
                    break;
                }
                
                row.appendChild(createCard(data[ind]));
                ind++;
            }

            itemContainer.appendChild(row);
        }
    }
    else {
        var emptyChild = document.createElement("p");
        emptyChild.setAttribute("class", "text-light fw-bold fs-1 text-center");
        emptyChild.innerHTML = "Empty Results";
        itemContainer.appendChild(emptyChild);
    }

}

function buildQueryParams() {
    var queryParams = {};
    
    var name = document.getElementById("itemNameInput").value;
    if(name != "") {
        queryParams["name"] = name;
    }

    var sellerName = document.getElementById("sellerNameInput").value;
    if(sellerName != "") {
        queryParams["sellerName"] = sellerName;
    }

    var category = document.getElementById("categorySelect").value;
    if(category != "") {
        queryParams["category"] = category;
    }

    var brand = document.getElementById("brandSelect").value;
    if(brand != "") {
        queryParams["brand"] = brand;
    }

    var order = document.getElementById("orderingSelect").value;
    if(order != "") {
        queryParams["ordering"] = order;
    }

    return queryParams;
}

document.addEventListener("DOMContentLoaded", () => {
    fetchItemData();
    
    //event grouping
    document.getElementById("submitSearch").addEventListener("click", (event) => {
        var queryParams = buildQueryParams();
        var queryUrl = new URLSearchParams(queryParams).toString();

        fetchItemData(`api/items?${queryUrl}`);
    });
});
