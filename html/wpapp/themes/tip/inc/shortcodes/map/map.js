(function ($, window, document, undefined) {
    'use strict';
    
    const tip_map = {
        init: function () {
            const mapContainer = document.getElementById('tip-map');
            if (!mapContainer || !maplibregl) return;
            const map = new maplibregl.Map({
                container: 'tip-map',
                style: 'https://basemap.startupgov.lt/vector/styles/bright/style.json',
                center: tip_map_config.coordinates,
                zoom: tip_map_config.zoom
            });
            console.log(tip_map_config);
            if (tip_map_config.add_layer === 'true') {
                //add layer here
            }else{
                const el = document.createElement('div');
                el.className = 'marker';
                el.style.backgroundImage = `url(${tip_map_config.pin.url})`;
                el.style.width = `${tip_map_config.pin.size[0]}px`;
                el.style.height = `${tip_map_config.pin.size[1]}px`;

                new maplibregl.Marker({element: el})
                    .setLngLat(tip_map_config.coordinates)
                    .addTo(map);
            }
        }
    }
    document.addEventListener('DOMContentLoaded', () => {
        tip_map.init();
    });

}(jQuery, window, document));