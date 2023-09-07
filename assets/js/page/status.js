import WebsocketConnector from '../components/WebsocketConnector'
import MapProgress from '../components/MapProgress'

$(() => {
  const wikimapiaMap = document.getElementById('map')
  const mapProgress = new MapProgress(wikimapiaMap, 24, 12)

  // websocket
  if (typeof websocketUrl !== 'undefined') {
    const websocket = new WebsocketConnector(websocketUrl, open)
  }

  function open(socket) {
    socket.subscribe('admin_progress', renderProgress)
  }

  function renderProgress(data) {
    if (data.type === 'wikimapia') {
      mapProgress.updateGrid(data.percent)
      $('.map-info').text(data.text.length ? data.text : `${data.percent}%`)
    }
  }
})
