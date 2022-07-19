export function getResultXML(data: string, tagName: string) {
  const parser = new DOMParser();
  const xml = parser.parseFromString(data, 'text/xml');
  return JSON.parse(xml.getElementsByTagName(tagName)[0].childNodes[0].nodeValue  || '{}')
}
