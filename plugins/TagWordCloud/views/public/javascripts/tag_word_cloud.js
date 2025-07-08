jQuery(() => {
    const tagWordCloudEl = document.getElementById('tag-word-cloud')
    if (!tagWordCloudEl) {
        return
    }

    const tags = JSON.parse(tagWordCloudEl.dataset.tags)
    const data = tags.filter(tag => tag.tagCount >= 5).map(tag => {
        return {
            name: tag.name,
            value: tag.tagCount,
        }
    })

    if (data.length == 0) {
        return
    }

    const chart = echarts.init(tagWordCloudEl)
    chart.setOption({
        series: [{
            type: 'wordCloud',
            // The shape of the "cloud" to draw. Can be any polar equation represented as a
            // callback function, or a keyword present. Available presents are circle (default),
            // cardioid (apple or heart shape curve, the most known polar equation), diamond (
            // alias of square), triangle-forward, triangle, (alias of triangle-upright, pentagon, and star.
            shape: 'circle',
            keepAspect: false,
            left: 'center',
            top: 'center',
            width: '100%',
            height: '100%',
            right: null,
            bottom: null,
            tooltip: {
                show: false,
            },
            // Text size range which the value in data will be mapped to.
            // Default to have minimum 12px and maximum 60px size.
            sizeRange: [12, 60],
            rotationRange: [-90, 90],
            rotationStep: 45,
            // size of the grid in pixels for marking the availability of the canvas
            // the larger the grid size, the bigger the gap between words.
            gridSize: 8,
            // set to true to allow word to be drawn partly outside of the canvas.
            // Allow word bigger than the size of the canvas to be drawn
            // This option is supported since echarts-wordcloud@2.1.0
            drawOutOfBound: false,
            // if the font size is too large for the text to be displayed,
            // whether to shrink the text. If it is set to false, the text will
            // not be rendered. If it is set to true, the text will be shrinked.
            // This option is supported since echarts-wordcloud@2.1.0
            shrinkToFit: true,
            // NOTE disable it will lead to UI blocking when there is lots of words.
            layoutAnimation: true,
            textStyle: {
                fontFamily: 'sans-serif',
                fontWeight: 'bold',
                // Color can be a callback function or a color string
                color: function () {
                    // Random color
                    return 'rgb(' + [
                        Math.round(Math.random() * 160),
                        Math.round(Math.random() * 160),
                        Math.round(Math.random() * 160)
                    ].join(',') + ')'
                }
            },
            emphasis: {
                focus: 'self',
                textStyle: {
                    textShadowBlur: 10,
                    textShadowColor: '#333'
                }
            },
            data: data,
        }]
    })
    chart.on('click', params => window.location.href = `/items/browse?tags=${encodeURIComponent(params.name)}`)
})