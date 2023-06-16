import type { AxiosInstance, AxiosResponse, InternalAxiosRequestConfig } from 'axios'
import axios from 'axios'
import moment from 'moment'

export class ApiService {

  private static _instance: ApiService

  private readonly _api: AxiosInstance

  private readonly _apiUrl: string

  constructor() {

    this._apiUrl = import.meta.env.VITE_API_URL?.toString()

    this._api = axios.create({
      baseURL: this._apiUrl,
    })

    this._api.interceptors.request.use((config: InternalAxiosRequestConfig) => {
      let url = config.url
      url = `${url}?t=${moment().unix()}`
      config.url = url
      return config
    }, (error) => {
      return Promise.reject(error)
    })

    this._api.interceptors.response.use((response: AxiosResponse) => {
      if (response.data.code === 0) {
        return response.data
      } else {
        return Promise.reject(response.data as ApiError)
      }
    }, (error) => {
      console.log('hong hong để show ví dụ tên đăng nhập sai đồ chẳng hạn code 801 đồ đi đó đó để hiện thị view ó')
      const newError: ApiError = {
        code: 1000,
        errrors: [],
        message: error?.message,
        status: false,
      }
      return Promise.reject(newError)
    })
  }

  static instance(): ApiService {
    // nếu ko có nó mới instance
    if (!this._instance) this._instance = new ApiService()
    return this._instance
  }

  public get axios(): AxiosInstance {
    const token = 'nsjdbshbshw123'
    this._api.defaults.headers.common['Authorization'] = `Bearer ${token}`
    return this._api
  }
}
