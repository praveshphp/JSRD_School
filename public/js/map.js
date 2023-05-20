
var markers = [];
window.marker_reits = [];
window.marker_reits_c = [];
window.markers_pp = [];
window.markers_cp = [];
window.markers_pi = [];
window.markers_pi2 = [];
let map;
var centerPosition = {
    lat: 42.144633499299815,
    lng: -95.79708347086952
};

var zoomLevel = 4;
window.markerCluster;
var markerClusterPI;
function initMap() {

    map = new google.maps.Map(document.getElementById("map"), {
        center: centerPosition,
        minZoom: 3,
        maxZoom: 21,
        zoom: zoomLevel,
        mapTypeId: 'roadmap',
    });

    map.setOptions({
        styles: skin
    });

    var infowindow2 = new google.maps.InfoWindow();
    var marker;

    const rendererreits = {
        render({ count, position }, stats) {
            const color = count > Math.max(10, stats.clusters.markers.mean) ? "#ff0000" : "#0000ff";
            const svg = window.btoa(`
          <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240">
            <circle cx="120" cy="120" opacity=".8" r="70" />
            <circle cx="120" cy="120" opacity=".5" r="90" />
            <circle cx="120" cy="120" opacity=".4" r="110" />
          </svg>`);
            return new google.maps.Marker({
                position,
                icon: {
                    url: `data:image/svg+xml;base64,${svg}`,
                    scaledSize: new google.maps.Size(45, 45),
                },
                label: {
                    text: String(count),
                    color: "rgba(255,255,255,0.9)",
                    fontSize: "12px",
                },
                title: `REITs`,
                zIndex: Number(google.maps.Marker.MAX_ZINDEX) + count,
            });
        }
    }
    markerClusterREITs = new markerClusterer.MarkerClusterer({
        map,
        marker,
        renderer: rendererreits,
        algorithm: new markerClusterer.SuperClusterAlgorithm({
            minZoom: 3,
            maxZoom: 21,
            minPoints: 5,
            radius: 140,
            extent: 512,
            nodeSize: 64,
        }),
    });
    jQuery.each(reit_arr, function (i, field) {
        // console.info(field)
        var position = new google.maps.LatLng(field.lat, field.lng)
        var marker_reits = new google.maps.Marker({
            position: position,
            // map,
            icon: field.icon,
            title: "REITs",
        });

        google.maps.event.addListener(marker_reits, 'click', function (ev) {
            if (infowindow2) {
                infowindow2.close();
            }
            infowindow2.setContent(field.pop);
            infowindow2.setPosition(position);
            infowindow2.open(map, marker_reits);
        });
        window.marker_reits["reits_" + field.id] = (marker_reits);
        if (typeof window.marker_reits_c[field.reit_companies] == 'undefined') {
            window.marker_reits_c[field.reit_companies] = [];
        }
        window.marker_reits_c[field.reit_companies].push(window.marker_reits["reits_" + field.id]);
        // window.markers_pp.push(marker_pp);
    });


    const rendererpp = {
        render({ count, position }, stats) {
            const color = count > Math.max(10, stats.clusters.markers.mean) ? "#ff0000" : "#0000ff";
            const svg = window.btoa(`
          <svg fill="#553FAF" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240">
            <circle cx="120" cy="120" opacity=".8" r="70" />
            <circle cx="120" cy="120" opacity=".5" r="90" />
            <circle cx="120" cy="120" opacity=".4" r="110" />
          </svg>`);
            return new google.maps.Marker({
                position,
                icon: {
                    url: `data:image/svg+xml;base64,${svg}`,
                    scaledSize: new google.maps.Size(45, 45),
                },
                label: {
                    text: String(count),
                    color: "rgba(255,255,255,0.9)",
                    fontSize: "12px",
                },
                title: `Potential Properties`,
                zIndex: Number(google.maps.Marker.MAX_ZINDEX) + count,
            });
        }
    }
    markerClusterPP = new markerClusterer.MarkerClusterer({
        map,
        marker,
        renderer: rendererpp,
        algorithm: new markerClusterer.SuperClusterAlgorithm({
            minZoom: 3,
            maxZoom: 21,
            minPoints: 5,
            radius: 140,
            extent: 512,
            nodeSize: 64,
        }),
    });
    jQuery.each(pp_arr, function (i, field) {
        // console.info(field)
        var position = new google.maps.LatLng(field.lat, field.lng)
        var marker_pp = new google.maps.Marker({
            position: position,
            // map,
            icon: field.icon,
            title: "Potential Properties",
        });

        google.maps.event.addListener(marker_pp, 'click', function (ev) {
            if (infowindow2) {
                infowindow2.close();
            }
            infowindow2.setContent(field.pop);
            infowindow2.setPosition(position);
            infowindow2.open(map, marker_pp);
        });
        window.markers_pp["pp_" + field.id] = (marker_pp);
        // window.markers_pp.push(marker_pp);
    });



    const renderercp = {
        render({ count, position }, stats) {
            const color = count > Math.max(10, stats.clusters.markers.mean) ? "#ff0000" : "#0000ff";
            const svg = window.btoa(`
          <svg fill="#5C8BD4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240">
            <circle cx="120" cy="120" opacity=".8" r="70" />
            <circle cx="120" cy="120" opacity=".5" r="90" />
            <circle cx="120" cy="120" opacity=".4" r="110" />
          </svg>`);
            return new google.maps.Marker({
                position,
                icon: {
                    url: `data:image/svg+xml;base64,${svg}`,
                    scaledSize: new google.maps.Size(45, 45),
                },
                label: {
                    text: String(count),
                    color: "rgba(255,255,255,0.9)",
                    fontSize: "12px",
                },
                title: `Competitor Properties`,
                zIndex: Number(google.maps.Marker.MAX_ZINDEX) + count,
            });
        }
    }

    markerClusterCP = new markerClusterer.MarkerClusterer({
        map,
        marker,
        renderer: renderercp,
        algorithm: new markerClusterer.SuperClusterAlgorithm({
            minZoom: 3,
            maxZoom: 21,
            minPoints: 5,
            radius: 140,
            extent: 512,
            nodeSize: 64,
        }),
    });

    jQuery.each(cp_arr, function (i, field) {
        // console.info(field)
        var position = new google.maps.LatLng(field.lat, field.lng)
        var marker_cp = new google.maps.Marker({
            position: position,
            //map,
            icon: field.icon,
            title: " Competitor Properties",
        });

        google.maps.event.addListener(marker_cp, 'click', function (ev) {
            if (infowindow2) {
                infowindow2.close();
            }
            infowindow2.setContent(field.pop);
            infowindow2.setPosition(position);
            infowindow2.open(map, marker_cp);
        });
        window.markers_cp["cp_" + field.id] = (marker_cp);
        // window.markers_cp.push(marker_cp);
    });

    const rendererpi = {
        render({ count, position }, stats) {
            const color = count > Math.max(10, stats.clusters.markers.mean) ? "#ff0000" : "#0000ff";
            const svg = window.btoa(`<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240">
            <circle cx="120" cy="120" r="110" stroke-width="3" fill="#E79736" opacity=".9"/>
            <circle cx="120" cy="120" r="90" stroke-width="3" fill="#7E3017"  opacity=".6" />
            <circle cx="120" cy="120" r="60" stroke-width="3" fill="#2C623F" opacity=".5" /></svg>`);
            return new google.maps.Marker({
                position,
                icon: {
                    url: `data:image/svg+xml;base64,${svg}`,
                    scaledSize: new google.maps.Size(45, 45),
                },
                label: {
                    text: String(count),
                    color: "rgba(255,255,255,0.9)",
                    fontSize: "12px",
                },
                title: `Points Of Interests`,
                zIndex: Number(google.maps.Marker.MAX_ZINDEX) + count,
            });
        }
    }

    markerClusterPI = new markerClusterer.MarkerClusterer({
        map,
        marker,
        renderer: rendererpi,
        algorithm: new markerClusterer.SuperClusterAlgorithm({
            minZoom: 3,
            maxZoom: 21,
            minPoints: 5,
            radius: 140,
            extent: 512,
            nodeSize: 64,
        }),
    });

    jQuery.each(pi_arr, function (i, field) {

        //console.info(field)
        var position = new google.maps.LatLng(field.lat, field.lng)
        var marker_pi = new google.maps.Marker({
            position: position,
            //map,
            icon: field.icon,
            title: field.poi_companies_name,
        });

        google.maps.event.addListener(marker_pi, 'click', function (ev) {
            if (infowindow2) {
                infowindow2.close();
            }
            infowindow2.setContent(field.pop);
            infowindow2.setPosition(position);
            infowindow2.open(map, marker_pi);
        });
        //window.markers_pi["pi_" + field.id] = (marker_pi);
        window.markers_pi["pi_" + field.id] = (marker_pi);
        if (typeof window.markers_pi2[field.poi_companies] == 'undefined') {
            window.markers_pi2[field.poi_companies] = [];
        }
        window.markers_pi2[field.poi_companies].push(window.markers_pi["pi_" + field.id]);
        //window.markers_pi.push(marker_pi);        
    });

}




window.initMap = initMap;

function clearPPMarkers() {
    markerClusterPP.clearMarkers();
    //setMapOnPP(null);
}

function showPPMarkers() {
    boundMarkersPP();
    //setMapOnPP(map);
}

function setMapOnPP(map) {
    for (var i in window.markers_pp) {
        window.markers_pp[i].setMap(map);
        window.markers_pp[i].setAnimation(google.maps.Animation.To);
    }
    // for (var i = 0; i < window.markers_pp.length; i++) {
    //     window.markers_pp[i].setMap(map);
    //     window.markers_pp[i].setAnimation(google.maps.Animation.To);
    // }
}

function clearCPMarkers() {
    markerClusterCP.clearMarkers();
    //setMapOnCP(null);
}

function showCPMarkers() {
    //setMapOnCP(map);
    boundMarkersCP();

}

function setMapOnCP(map) {
    for (var i in window.markers_cp) {
        window.markers_cp[i].setMap(map);
        window.markers_cp[i].setAnimation(google.maps.Animation.To);
    }
    // for (var i = 0; i < window.markers_cp.length; i++) {
    //     window.markers_cp[i].setMap(map);
    //     window.markers_cp[i].setAnimation(google.maps.Animation.To);
    // }
}

function clearPIMarkers() {
    setMapOnPI(null);
}
function clearPIMarkers2() {
    setMapOnPI2(null, []);

}
function showPIMarkers() {
    setMapOnPI(map);
}

function setMapOnPI(map) {
    for (var i in window.markers_pi) {
        window.markers_pi[i].setMap(map);
        window.markers_pi[i].setAnimation(google.maps.Animation.To);
    }
}
function showPIMarkers2(company_id) {
    clearPIMarkers2();
    setMapOnPI2(map, company_id);
}
window.markers_pi3 = [];
function setMapOnPI2(map, company_id) {
    window.markers_pi3 = [];
    if (company_id == '') {
        for (var company_id in window.markers_pi2) {
            for (var j in window.markers_pi2[company_id]) {
                //  window.markers_pi2[company_id][j].setMap(map);
                // window.markers_pi2[company_id][j].setAnimation(google.maps.Animation.To);
                window.markers_pi3.push(window.markers_pi2[company_id][j]);
            }
        }
    } else {
        for (let index = 0; index < company_id.length; ++index) {
            if (typeof window.markers_pi2[company_id[index]] !== 'undefined') {
                for (var j in window.markers_pi2[company_id[index]]) {
                    // window.markers_pi2[company_id[index]][j].setMap(map);
                    // window.markers_pi2[company_id[index]][j].setAnimation(google.maps.Animation.To);                    
                    if (typeof window.markers_pi2[company_id[index]][j] !== 'undefined') {
                        window.markers_pi3.push(window.markers_pi2[company_id[index]][j]);
                    }
                }
            }
        }
    }
    //  markerClusterPI.addMarkers(window.markers_pi3);
}
$(document).ready(function () {
    google.maps.event.addListener(map, 'bounds_changed', boundMarkersPi);
    google.maps.event.addListener(map, 'bounds_changed', boundMarkersCP);
});
function boundMarkersPi() {
    if (jQuery.inArray('pi', JSON.parse(localStorage.getItem('all_category'))) > -1) {
        //if (jQuery.inArray('pi', JSON.parse(localStorage.getItem('all_category'))) > -1 && jQuery.inArray('2', JSON.parse(localStorage.getItem('sub_category'))) > -1) {

        markerClusterPI.clearMarkers();
        var bounds = map.getBounds();
        window.markers_pi4 = [];
        for (var i = 0; i < window.markers_pi3.length; i++) {
            if (bounds.contains(window.markers_pi3[i].getPosition())) {
                //console.info(map.markers2[i])
                window.markers_pi4.push(window.markers_pi3[i]);
            }

        }
        markerClusterPI.addMarkers(window.markers_pi4);
        //boundMarkersPi();
    }
}
function boundMarkersCP() {
    if (jQuery.inArray('cp', JSON.parse(localStorage.getItem('all_category'))) > -1) {
        markerClusterCP.clearMarkers();
        var bounds = map.getBounds();
        window.markers_cp4 = [];
        for (var key in window.markers_cp) {
            if (window.markers_cp.hasOwnProperty(key)) {
                if (bounds.contains(window.markers_cp[key].getPosition())) {
                    window.markers_cp4.push(window.markers_cp[key]);
                }
            }
        }
        markerClusterCP.addMarkers(window.markers_cp4);
    }
}
function boundMarkersPP() {
    if (jQuery.inArray('pp', JSON.parse(localStorage.getItem('all_category'))) > -1) {
        markerClusterPP.clearMarkers();
        var bounds = map.getBounds();
        window.markers_cp5 = [];
        for (var key in window.markers_pp) {
            if (window.markers_pp.hasOwnProperty(key)) {
                if (bounds.contains(window.markers_pp[key].getPosition())) {
                    window.markers_cp5.push(window.markers_pp[key]);
                }
            }
        }
        markerClusterPP.addMarkers(window.markers_cp5);
    }
}

function boundMarkersREITs(company_id) {
    //if (jQuery.inArray('pp', JSON.parse(localStorage.getItem('all_category'))) > -1) {
    markerClusterREITs.clearMarkers();
    var bounds = map.getBounds();
    window.marker_reits_2 = [];
    // marker_reits_c

    for (let index = 0; index < company_id.length; ++index) {
        if (typeof window.marker_reits_c[company_id[index]] !== 'undefined') {
            for (var j in window.marker_reits_c[company_id[index]]) {
                // window.markers_pi2[company_id[index]][j].setMap(map);
                // window.markers_pi2[company_id[index]][j].setAnimation(google.maps.Animation.To);                    
                if (typeof window.marker_reits_c[company_id[index]][j] !== 'undefined') {
                    window.marker_reits_2.push(window.marker_reits_c[company_id[index]][j]);
                }
            }
        }
    }

    // for (var key in window.marker_reits) {
    //     if (window.marker_reits.hasOwnProperty(key)) {
    //         if (bounds.contains(window.marker_reits[key].getPosition())) {
    //             window.marker_reits_2.push(window.marker_reits[key]);
    //         }
    //     }
    // }
    markerClusterREITs.addMarkers(window.marker_reits_2);
    // }
}
$('#reits_companies_options').on("change", function () {

    boundMarkersREITs($(this).val());
});
$(document).ready(function () {
    const $_SELECT_PICKER_FILTER = $("#checkbox");
    $_SELECT_PICKER_FILTER.find('option').each((idx, elem) => {
        const $OPTION = $(elem);
        const IMAGE_URL = $OPTION.attr('data-thumbnail');
        if (IMAGE_URL) {
            $OPTION.attr('data-content', "<img src='%i' height='30'/> %s".replace(/%i/, IMAGE_URL)
                .replace(/%s/,
                    $OPTION.text()))
        }

    });
    $_SELECT_PICKER_FILTER.selectpicker({
        selectAllText: 'All',
        deselectAllText: '',
        noneSelectedText: "Select Options"
    });

    if (localStorage.getItem('all_category')) {
        $_SELECT_PICKER_FILTER.selectpicker('val', JSON.parse(localStorage.getItem('all_category')));
        if (jQuery.inArray('pi', JSON.parse(localStorage.getItem('all_category'))) <= -1) {
            jQuery('.poicompanies').attr('style', 'display: none !important');
        }
    } else {
        localStorage.setItem("all_category", JSON.stringify(['pp', 'cp', 'pi']));
        $_SELECT_PICKER_FILTER.selectpicker('val', ['pp', 'cp', 'pi']);
    }

    const $_SELECT_PICKER_POICOM = $("#poicompanies");
    $_SELECT_PICKER_POICOM.find('option').each((idx, elem) => {
        const $OPTION = $(elem);
        const IMAGE_URL = $OPTION.attr('data-thumbnail');
        if (IMAGE_URL) {
            $OPTION.attr('data-content', "<img src='%i' height='25'/> %s".replace(/%i/, IMAGE_URL)
                .replace(/%s/,
                    $OPTION.text()))
        }

    });
    $_SELECT_PICKER_POICOM.selectpicker({
        selectAllText: 'All Point of Interest Companies',
        deselectAllText: '',
        noneSelectedText: "Select Point of Interest Companies"
    });


    if (localStorage.getItem('sub_category')) {
        $_SELECT_PICKER_POICOM.selectpicker('val', JSON.parse(localStorage.getItem('sub_category')));
    } else {
        localStorage.setItem("sub_category", JSON.stringify([10]));
        $_SELECT_PICKER_POICOM.selectpicker('val', [10]);

    }

});

jQuery(document).on('change', '#checkbox', function () {

    var selected = []; //array to store value
    $(this).find("option:selected").each(function (key, value) {
        selected.push(value.value); //push the text to array                    
    });

    if (jQuery.inArray('pp', selected) > -1) {
        showPPMarkers()
        setTimeout(function () {
            boundMarkersPP();
        }, 50)
    } else {
        clearPPMarkers();
        markerClusterPP.clearMarkers();
    }
    if (jQuery.inArray('cp', selected) > -1) {
        showCPMarkers()
        setTimeout(function () {
            boundMarkersCP();
        }, 50)

    } else {
        clearCPMarkers();
        markerClusterCP.clearMarkers();
    }
    if (jQuery.inArray('pi', selected) > -1) {

        if (localStorage.getItem('sub_category')) {
            $("#poicompanies").selectpicker('val', JSON.parse(localStorage.getItem('sub_category')));
            showPIMarkers2(JSON.parse(localStorage.getItem('sub_category')));
        } else {
            $("#poicompanies").selectpicker('val', pi_companies_keys);
            localStorage.setItem("sub_category", JSON.stringify(pi_companies_keys));
            showPIMarkers2(pi_companies_keys)
        }
        jQuery('.poicompanies').attr('style', 'display: inline-block !important');

        setTimeout(function () {
            boundMarkersPi();
        }, 50);
    } else {
        markerClusterPI.clearMarkers();
        clearPIMarkers2();
        localStorage.removeItem('sub_category')
        jQuery('.poicompanies').attr('style', 'display: none !important');
    }
    localStorage.setItem("all_category", JSON.stringify(selected));

});

jQuery(document).on('change', '#poicompanies', function () {
    var selecteded = [];
    $(this).find("option:selected").each(function (key, value) {
        selecteded.push(value.value); //push the text to array                    
    });
    if (selecteded.length <= 0) {
        selecteded = [10]
    }
    localStorage.setItem("sub_category", JSON.stringify(selecteded));
    showPIMarkers2(selecteded);

    if (jQuery.inArray('2', selecteded) > -1 || jQuery.inArray('1', selecteded) > -1 || jQuery.inArray('3', selecteded) > -1) {
        boundMarkersPi();
    } else {
        markerClusterPI.clearMarkers();
    }
});
window.addEventListener('hashchange', function () {
    openMapPopup();
}, false);

window.addEventListener('load', function () {
    openMapPopup();
}, false);

function openMapPopup() {
    var nameHash = location.hash;
    var newHashName = nameHash.replace("#", "");
    var newHashNameType = newHashName.split("_");

    if (typeof newHashNameType !== 'undefined') {
        if (newHashNameType[0] == 'pp') {
            if (localStorage.getItem('all_category')) {
                if (jQuery.inArray('pp', JSON.parse(localStorage.getItem('all_category'))) == -1) {
                    const pp = JSON.parse(localStorage.getItem('all_category'));
                    pp.push('pp')
                    localStorage.setItem("all_category", JSON.stringify(pp));
                    $("#checkbox").selectpicker('val', pp);
                }
            } else {
                localStorage.setItem("all_category", JSON.stringify(['pp']));
                $("#checkbox").selectpicker('val', ['pp']);
            }
            boundMarkersPP()
            map.panTo(window.markers_pp[newHashName].getPosition());
            map.setZoom(parseInt(15));
            google.maps.event.trigger(window.markers_pp[newHashName], 'click');
        } else if (newHashNameType[0] == 'cp') {
            if (localStorage.getItem('all_category')) {
                if (jQuery.inArray('cp', JSON.parse(localStorage.getItem('all_category'))) == -1) {
                    const cp = JSON.parse(localStorage.getItem('all_category'));
                    cp.push('cp')
                    localStorage.setItem("all_category", JSON.stringify(cp));
                    $("#checkbox").selectpicker('val', cp);
                }
            } else {
                localStorage.setItem("all_category", JSON.stringify(['cp']));
                $("#checkbox").selectpicker('val', ['cp']);
            }
            boundMarkersCP()
            map.panTo(window.markers_cp[newHashName].getPosition());
            map.setZoom(parseInt(15));
            google.maps.event.trigger(window.markers_cp[newHashName], 'click');

        } else if (newHashNameType[0] == 'pi') {
            if (localStorage.getItem('all_category')) {
                if (jQuery.inArray('pi', JSON.parse(localStorage.getItem('all_category'))) == -1) {
                    const p = JSON.parse(localStorage.getItem('all_category'));
                    p.push('pi')
                    localStorage.setItem("all_category", JSON.stringify(p));
                    $("#checkbox").selectpicker('val', p);
                    jQuery('.poicompanies').attr('style', 'display: inline-block !important');


                } else {
                    setTimeout(() => {
                        $("#poicompanies").selectpicker('val', pi_companies_keys);
                        localStorage.setItem("sub_category", JSON.stringify(pi_companies_keys));
                        //alert('aa')
                    }, 200);
                }
            } else {
                localStorage.setItem("all_category", JSON.stringify(['pi']));
                $("#checkbox").selectpicker('val', ['pi']);
            }

            //boundMarkersPi()
            showPIMarkers2('');
            map.panTo(window.markers_pi[newHashName].getPosition());
            map.setZoom(parseInt(15));
            google.maps.event.trigger(window.markers_pi[newHashName], 'click');
        }
    }
    removeHash();
}
function removeHash() {
    var scrollV, scrollH, loc = window.location;
    if ("pushState" in history)
        history.pushState("", document.title, loc.pathname + loc.search);
    else {
        // Prevent scrolling by storing the page's current scroll offset
        scrollV = document.body.scrollTop;
        scrollH = document.body.scrollLeft;

        loc.hash = "";

        // Restore the scroll offset, should be flicker free
        document.body.scrollTop = scrollV;
        document.body.scrollLeft = scrollH;
    }
}