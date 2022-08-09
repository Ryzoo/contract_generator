const defaultTitle = "LIBRARY_ATTRIBUTES_";
const defaultState = {
  draftList: [],
  defaultDraft: {
    id: null,
    name: "",
    description: "",
    category: null,
    content: [],
  },
};

const actions = {
  library_attributes_addDraft: (context, data) => {
    context.commit(`${defaultTitle}ADD_DRAFT`, data);
  },
  library_attributes_updateDraft: (context, data) => {
    context.commit(`${defaultTitle}UPDATE_DRAFT`, data);
  },
  library_attributes_deleteDraft: (context, data) => {
    context.commit(`${defaultTitle}DELETE_DRAFT`, data);
  },
  library_attributes_setDraftList: (context, data) => {
    context.commit(`${defaultTitle}SET_DRAFT_LIST`, data);
  },
};

const mutations = {
  [`${defaultTitle}ADD_DRAFT`]: (state, draft) => {
    state.draftList.push({
      ...draft,
    });
  },
  [`${defaultTitle}UPDATE_DRAFT`]: (state, draft) => {
    state.draftList = state.draftList.map((x) => {
      if (parseInt(x.id) === parseInt(draft.id)) {
        return {
          ...draft,
        };
      }
      return x;
    });
  },
  [`${defaultTitle}SET_DRAFT_LIST`]: (state, draftList) => {
    state.draftList = draftList.map((x) => ({
      ...x,
      id: parseInt(x.id),
      content: JSON.parse(x.content),
    }));
  },
  [`${defaultTitle}DELETE_DRAFT`]: (state, draftId) => {
    state.draftList = state.draftList.filter(
      (x) => parseInt(x.id) !== parseInt(draftId)
    );
  },
};

const getters = {
  library_attributes_getDraftList: (state) => {
    return state.draftList;
  },
  library_attributes_getDefaultDraft: (state) => {
    return state.defaultDraft;
  },
  library_attributes_getExistedDraft: (state) => (id) => {
    return state.draftList.find((x) => parseInt(x.id) === parseInt(id));
  },
  library_attributes_getAttributeContent: (state) => (id) => {
    const draft = state.draftList.find((x) => parseInt(x.id) === parseInt(id));
    return draft ? draft.content : [];
  },
};

export default {
  state: defaultState,
  getters,
  actions,
  mutations,
};
