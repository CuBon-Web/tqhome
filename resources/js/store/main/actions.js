// import axios from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';
import {HTTP} from '../../core/plugins/http'

export const loadings = (context, bol) => {
        context.commit('SET_LOADING', bol);
};

export const saveBanner  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/banner', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listBanner  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-banner', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const savePartner  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/partner', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listPartner  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-partner', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listVideo  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-video', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const saveVideo  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/video', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listAlbumAffter  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-albumaffter', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const saveAlbumAffter  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/albumaffter', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listPrize  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-prize', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const savePrize  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/prize', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const getDataChart = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/home/chart', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const getRevenue = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/home/revenue').then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const getStatisticalBill = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/home/statistical-bill').then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const getTrafficPage = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/home/analytics').then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const getOverviewDashboard = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/home/overview').then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const searchNavbar = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/home/search_navbar',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const saveFounder  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/founder', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listFounder  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-founder', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const saveWhyChoose = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/why-choose', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};
export const listWhyChoose = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-why-choose', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const saveCoreValue = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/core-value', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};
export const listCoreValue = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-core-value', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const saveHistoryMilestone = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/history-milestone', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};
export const listHistoryMilestone = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-history-milestone', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const saveProcessStep = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/process-step', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const listProcessStep = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-process-step').then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const saveFaq = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/faq', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const listFaq = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-faq').then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const saveProductProfileCategory = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/product-profile-category', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const listProductProfileCategories = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-product-profile').then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const getProductProfileCategory = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/product-profile-category/' + opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const deleteProductProfileCategory = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/product-profile-category/delete/' + opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const saveProductProfileDocuments = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/product-profile-documents/' + opt.categoryId, {
            documents: opt.documents,
        }).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};
