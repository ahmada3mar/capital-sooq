import Repository, { baseUrl } from '~/repositories/repository.js';


export default function ({ route }) {
    if(!route.name.includes("coming-soon"))
    return Repository.get('/demo8')
  }