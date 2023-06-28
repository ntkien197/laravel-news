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
      const newError: ApiError = {
        code: 1000,
        errors: [],
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
    const token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2ODcyNDMyNTQsImV4cCI6MTY4NzI0Njg1NCwibmJmIjoxNjg3MjQzMjU0LCJqdGkiOiJaV3Q4WU9LQ2hubkFEYmRWIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.DWssQhl2yJmm-IthfL1a3TgV7wNXsUSQALVWPdSsArg'
    this._api.defaults.headers.common['Authorization'] = `Bearer ${token}`
    return this._api
  }
}
